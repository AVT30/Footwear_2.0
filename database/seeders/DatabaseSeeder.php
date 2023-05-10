<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //ici je défini l'ordre d'execution des seeders pour eviter que les erreurs des tables dependates qui ne créent pas de données si les tables parents n'ont pas enceore faire de seeder
        $this->call([
            listTypeChaussure::class,
            ChaussuresTableSeeder::class,
            UtilisateursTableSeeder::class,
            PaysTableSeeder::class,
            TaillesTableSeeder::class,
            TypeTableSeeder::class,
            ImageTableSeeder::class,
        ]);

    }
}
