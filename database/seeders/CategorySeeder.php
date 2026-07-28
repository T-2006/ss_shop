<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            'Camisetas',
            'Pantalones',
            'Vestidos',
            'Chaquetas',
            'Zapatos',
            'Accesorios',
            'Bolsos',
            'Gorras',
        ];

        foreach ($categorias as $nombre) {
            Category::firstOrCreate(
                ['slug' => Str::slug($nombre)],
                ['nombre' => $nombre]
            );
        }
    }
}
