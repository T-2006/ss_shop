<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;

class PanelController extends Controller
{
    /**
     * Panel principal: resumen general de la tienda.
     */
    public function index()
    {
        $totalProductos = Product::count();
        $totalCategorias = Category::count();
        $totalVariantes = ProductVariant::count();
        $variantesBajoStock = ProductVariant::where('stock', '<=', 5)->with('product')->orderBy('stock')->take(8)->get();
        $stockTotal = ProductVariant::sum('stock');

        return view('admin.panel', compact(
            'totalProductos',
            'totalCategorias',
            'totalVariantes',
            'variantesBajoStock',
            'stockTotal'
        ));
    }
}
