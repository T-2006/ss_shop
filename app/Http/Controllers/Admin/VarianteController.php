<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class VarianteController extends Controller
{
    public function store(Request $request, Product $producto)
    {
        $datos = $request->validate([
            'talla' => ['required', 'string', 'max:20'],
            'color' => ['nullable', 'string', 'max:50'],
            'stock' => ['required', 'integer', 'min:0'],
            'sku_variante' => ['required', 'string', 'max:120', 'unique:product_variants,sku_variante'],
        ]);

        $producto->variants()->create($datos);

        return redirect()->route('admin.productos.edit', $producto)->with('mensaje', 'Variante agregada correctamente.');
    }

    public function update(Request $request, Product $producto, ProductVariant $variante)
    {
        $datos = $request->validate([
            'talla' => ['required', 'string', 'max:20'],
            'color' => ['nullable', 'string', 'max:50'],
            'stock' => ['required', 'integer', 'min:0'],
            'sku_variante' => ['required', 'string', 'max:120', 'unique:product_variants,sku_variante,' . $variante->id],
        ]);

        $variante->update($datos);

        return redirect()->route('admin.productos.edit', $producto)->with('mensaje', 'Variante actualizada correctamente.');
    }

    public function destroy(Product $producto, ProductVariant $variante)
    {
        $variante->delete();

        return redirect()->route('admin.productos.edit', $producto)->with('mensaje', 'Variante eliminada.');
    }
}
