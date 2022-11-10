<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\TipoAcceso;
use App\Models\TipoDocumento;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SexoSeeder::class,
            TipoDocumentoSeeder::class,
            TipoAccesoSeeder::class,
            RoleSeeder::class,
            PersonaSeeder::class,
            MenuSeeder::class
        ]);
    }
}
