<?php

namespace App\Support;

class Tallas
{
    /**
     * Devuelve las tallas sugeridas según el slug de la categoría.
     * Si la categoría no está mapeada, se sugiere "Única" por defecto.
     */
    public static function porCategoria(string $slugCategoria): array
    {
        return match ($slugCategoria) {
            'camisetas', 'chaquetas' => ['XS', 'S', 'M', 'L', 'XL', 'XXL'],
            'vestidos' => ['XS', 'S', 'M', 'L', 'XL'],
            'pantalones' => ['28', '30', '32', '34', '36', '38', '40'],
            'zapatos' => ['35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45'],
            'gorras', 'bolsos' => ['Única'],
            'accesorios' => ['Única', '28', '30', '32', '34', '36', '38'],
            default => ['Única'],
        };
    }
}
