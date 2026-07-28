<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    /**
     * Muestra la pagina principal con las categorias y productos activos.
     */
    public function index()
    {
        // 1. Obtener los productos activos con sus relaciones
        $productos = Product::with(['category', 'variants'])
            ->where('activo', true)
            ->latest()
            ->get();

        // 2. Obtener todas las categorias ordenadas por nombre
        $categorias = Category::orderBy('nombre')->get();

        // 3. Retornar la vista 'inicio' pasando las variables necesarias
        return view('inicio', compact('productos', 'categorias'));
    }
}