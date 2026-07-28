<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Category::withCount('products')->orderBy('nombre')->get();

        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias.crear');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
        ]);

        Category::create([
            'nombre' => $datos['nombre'],
            'slug' => Str::slug($datos['nombre']),
        ]);

        return redirect()->route('admin.categorias.index')->with('mensaje', 'Categoría creada correctamente.');
    }

    public function edit(Category $categoria)
    {
        return view('admin.categorias.editar', compact('categoria'));
    }

    public function update(Request $request, Category $categoria)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
        ]);

        $categoria->update([
            'nombre' => $datos['nombre'],
            'slug' => Str::slug($datos['nombre']),
        ]);

        return redirect()->route('admin.categorias.index')->with('mensaje', 'Categoría actualizada correctamente.');
    }

    public function destroy(Category $categoria)
    {
        if ($categoria->products()->exists()) {
            return redirect()->route('admin.categorias.index')
                ->with('error', 'No puedes eliminar una categoría que tiene productos asociados.');
        }

        $categoria->delete();

        return redirect()->route('admin.categorias.index')->with('mensaje', 'Categoría eliminada.');
    }
}
