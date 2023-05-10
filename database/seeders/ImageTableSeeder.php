<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\ImageChaussure;
use App\Models\Chaussure;
use Illuminate\Support\Facades\DB;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            [
                'id_chaussure' => 1, // L'ID de la première chaussure
                'image_chaussure' => 'asics.jpg', // Remplacez par le chemin d'accès à l'image spécifique
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 2, // L'ID de la deuxième chaussure
                'image_chaussure' => 'asics2.jpg', // Remplacez par le chemin d'accès à l'image spécifique
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Ajoutez d'autres entrées d'images pour d'autres chaussures
        ];

        DB::table('image_chaussures')->insert($images);
    }
}
