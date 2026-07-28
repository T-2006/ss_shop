<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MigracionTemporalController extends Controller
{
    /**
     * Ejecuta las migraciones y los seeders una sola vez, protegido por un
     * token secreto definido en las variables de entorno (MIGRATION_TOKEN).
     *
     * IMPORTANTE: elimina esta ruta y este archivo después de usarlo una vez.
     */
    public function ejecutar(Request $request)
    {
        if ($request->query('token') !== env('MIGRATION_TOKEN')) {
            abort(403, 'Token inválido.');
        }

        Artisan::call('migrate', ['--force' => true]);
        $salidaMigracion = Artisan::output();

        $conSeed = $request->query('seed') === '1';
        $salidaSeed = '';

        if ($conSeed) {
            Artisan::call('db:seed', ['--force' => true]);
            $salidaSeed = Artisan::output();
        }

        return response()->json([
            'migracion' => $salidaMigracion,
            'seed' => $salidaSeed ?: 'No se ejecutó (agrega ?seed=1 a la URL si lo necesitas)',
        ]);
    }
}
