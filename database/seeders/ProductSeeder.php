<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            [
                'categoria' => 'camisetas',
                'nombre' => 'Camiseta Oversize Algodón',
                'descripcion' => 'Camiseta de algodón 100% con corte oversize.',
                'sku' => 'CAM-OVS-001',
                'precio' => 69900,
                'variantes' => [
                    ['talla' => 'S', 'color' => 'Blanco', 'stock' => 12],
                    ['talla' => 'M', 'color' => 'Blanco', 'stock' => 20],
                    ['talla' => 'L', 'color' => 'Negro', 'stock' => 15],
                ],
            ],
            [
                'categoria' => 'pantalones',
                'nombre' => 'Pantalón Cargo Slim',
                'descripcion' => 'Pantalón cargo con bolsillos laterales, corte slim.',
                'sku' => 'PAN-CRG-001',
                'precio' => 129900,
                'variantes' => [
                    ['talla' => '30', 'color' => 'Verde', 'stock' => 8],
                    ['talla' => '32', 'color' => 'Verde', 'stock' => 10],
                    ['talla' => '34', 'color' => 'Beige', 'stock' => 6],
                ],
            ],
            [
                'categoria' => 'vestidos',
                'nombre' => 'Vestido Midi Lino',
                'descripcion' => 'Vestido midi en lino fresco, ideal para clima cálido.',
                'sku' => 'VES-MDI-001',
                'precio' => 159900,
                'variantes' => [
                    ['talla' => 'S', 'color' => 'Terracota', 'stock' => 5],
                    ['talla' => 'M', 'color' => 'Terracota', 'stock' => 7],
                ],
            ],
            [
                'categoria' => 'chaquetas',
                'nombre' => 'Chaqueta Denim Clásica',
                'descripcion' => 'Chaqueta de jean clásica con botones metálicos.',
                'sku' => 'CHA-DEN-001',
                'precio' => 189900,
                'variantes' => [
                    ['talla' => 'M', 'color' => 'Azul', 'stock' => 9],
                    ['talla' => 'L', 'color' => 'Azul', 'stock' => 11],
                ],
            ],
            [
                'categoria' => 'zapatos',
                'nombre' => 'Zapatillas Urban Running',
                'descripcion' => 'Zapatillas ligeras para uso diario.',
                'sku' => 'ZAP-URB-001',
                'precio' => 219900,
                'variantes' => [
                    ['talla' => '38', 'color' => 'Negro', 'stock' => 4],
                    ['talla' => '40', 'color' => 'Negro', 'stock' => 6],
                    ['talla' => '42', 'color' => 'Blanco', 'stock' => 3],
                ],
            ],
            [
                'categoria' => 'gorras',
                'nombre' => 'Gorra Bordada Clásica',
                'descripcion' => 'Gorra ajustable con bordado frontal.',
                'sku' => 'GOR-CLA-001',
                'precio' => 49900,
                'variantes' => [
                    ['talla' => 'Única', 'color' => 'Negro', 'stock' => 25],
                    ['talla' => 'Única', 'color' => 'Beige', 'stock' => 18],
                ],
            ],
            [
                'categoria' => 'bolsos',
                'nombre' => 'Bolso Tote Cuero Sintético',
                'descripcion' => 'Bolso tote espacioso, ideal para el día a día.',
                'sku' => 'BOL-TOT-001',
                'precio' => 149900,
                'variantes' => [
                    ['talla' => 'Única', 'color' => 'Café', 'stock' => 7],
                ],
            ],
            [
                'categoria' => 'accesorios',
                'nombre' => 'Cinturón Cuero Reversible',
                'descripcion' => 'Cinturón reversible negro/café, hebilla metálica.',
                'sku' => 'ACC-CIN-001',
                'precio' => 59900,
                'variantes' => [
                    ['talla' => '32', 'color' => 'Negro/Café', 'stock' => 14],
                    ['talla' => '34', 'color' => 'Negro/Café', 'stock' => 10],
                ],
            ],
        ];

        foreach ($productos as $datos) {
            $categoria = Category::where('slug', $datos['categoria'])->first();

            if (! $categoria) {
                continue;
            }

            $producto = Product::firstOrCreate(
                ['sku' => $datos['sku']],
                [
                    'category_id' => $categoria->id,
                    'nombre' => $datos['nombre'],
                    'descripcion' => $datos['descripcion'],
                    'precio' => $datos['precio'],
                    'activo' => true,
                ]
            );

            foreach ($datos['variantes'] as $index => $variante) {
                $producto->variants()->firstOrCreate(
                    ['sku_variante' => $datos['sku'].'-'.($index + 1)],
                    [
                        'talla' => $variante['talla'],
                        'color' => $variante['color'],
                        'stock' => $variante['stock'],
                    ]
                );
            }
        }
    }
}
