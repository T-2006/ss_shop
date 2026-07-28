<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Support\Tallas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $productos = Product::with('category', 'variants')
            ->when($request->buscar, function ($query, $buscar) {
                $query->where('nombre', 'like', "%{$buscar}%")
                      ->orWhere('sku', 'like', "%{$buscar}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Category::orderBy('nombre')->get();

        // Tallas sugeridas por cada categoría, para que el JS del formulario
        // pueda actualizar el selector de tallas cuando cambies de categoría.
        $tallasPorCategoria = $categorias->mapWithKeys(function ($categoria) {
            return [$categoria->id => Tallas::porCategoria($categoria->slug)];
        });

        return view('admin.productos.crear', compact('categorias', 'tallasPorCategoria'));
    }

    public function store(Request $request)
    {
        $datos = $this->validarDatos($request);

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $datos['activo'] = $request->boolean('activo');

        $producto = DB::transaction(function () use ($datos, $request) {
            $producto = Product::create($datos);

            $this->guardarVariantes($request, $producto);

            return $producto;
        });

        return redirect()->route('admin.productos.edit', $producto)->with('mensaje', 'Producto creado correctamente.');
    }

    public function edit(Product $producto)
    {
        $producto->load('variants');
        $categorias = Category::orderBy('nombre')->get();

        return view('admin.productos.editar', compact('producto', 'categorias'));
    }

    public function update(Request $request, Product $producto)
    {
        $datos = $this->validarDatos($request, $producto->id);

        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $datos['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $datos['activo'] = $request->boolean('activo');

        $producto->update($datos);

        return redirect()->route('admin.productos.edit', $producto)->with('mensaje', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $producto)
    {
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();

        return redirect()->route('admin.productos.index')->with('mensaje', 'Producto eliminado.');
    }

    private function validarDatos(Request $request, $idProducto = null): array
    {
        return $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'sku' => ['required', 'string', 'max:100', 'unique:products,sku,' . $idProducto],
            'precio' => ['required', 'numeric', 'min:0'],
            'imagen' => ['nullable', 'image', 'max:2048'],
        ]);
    }

    /**
     * Guarda las variantes (tallas) enviadas dinámicamente desde el formulario
     * de creación. Filas vacías (sin talla) se ignoran.
     */
    private function guardarVariantes(Request $request, Product $producto): void
    {
        $variantes = $request->input('variantes', []);

        foreach ($variantes as $indice => $variante) {
            $talla = trim($variante['talla'] ?? '');

            if ($talla === '') {
                continue;
            }

            $skuVariante = trim($variante['sku_variante'] ?? '');

            if ($skuVariante === '') {
                $skuVariante = $this->generarSkuVariante($producto->sku, $indice + 1);
            }

            $producto->variants()->create([
                'talla' => $talla,
                'color' => $variante['color'] ?? null,
                'stock' => (int) ($variante['stock'] ?? 0),
                'sku_variante' => $skuVariante,
            ]);
        }
    }

    /**
     * Genera un SKU de variante único a partir del SKU del producto,
     * evitando choques si ya existe uno igual en la base de datos.
     */
    private function generarSkuVariante(string $skuProducto, int $numero): string
    {
        $base = $skuProducto . '-' . $numero;
        $sku = $base;
        $intento = 1;

        while (\App\Models\ProductVariant::where('sku_variante', $sku)->exists()) {
            $intento++;
            $sku = $base . '-' . $intento;
        }

        return $sku;
    }
}
