<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $variantes = ProductVariant::with('product.category')
            ->when($request->buscar, function ($query, $buscar) {
                $query->where('sku_variante', 'like', "%{$buscar}%")
                      ->orWhereHas('product', function ($q) use ($buscar) {
                          $q->where('nombre', 'like', "%{$buscar}%");
                      });
            })
            ->join('products', 'products.id', '=', 'product_variants.product_id')
            ->orderBy('products.nombre')
            ->select('product_variants.*')
            ->paginate(15)
            ->withQueryString();

        $movimientosRecientes = StockMovement::with('variant.product', 'user')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.stock.index', compact('variantes', 'movimientosRecientes'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'product_variant_id' => ['required', 'exists:product_variants,id'],
            'tipo' => ['required', 'in:entrada,salida'],
            'cantidad' => ['required', 'integer', 'min:1'],
        ]);

        $variante = ProductVariant::findOrFail($datos['product_variant_id']);

        if ($datos['tipo'] === 'salida' && $datos['cantidad'] > $variante->stock) {
            return back()->with('error', 'No puedes registrar una salida mayor al stock disponible (' . $variante->stock . ').');
        }

        DB::transaction(function () use ($datos, $variante) {
            StockMovement::create([
                'product_variant_id' => $variante->id,
                'user_id' => Auth::id(),
                'tipo' => $datos['tipo'],
                'cantidad' => $datos['cantidad'],
            ]);

            if ($datos['tipo'] === 'entrada') {
                $variante->increment('stock', $datos['cantidad']);
            } else {
                $variante->decrement('stock', $datos['cantidad']);
            }
        });

        return redirect()->route('admin.stock.index')->with('mensaje', 'Movimiento de stock registrado correctamente.');
    }
}
