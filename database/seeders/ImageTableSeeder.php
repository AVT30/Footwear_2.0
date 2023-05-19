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
                'image_chaussure' => 'AIR MAX 90 WHITE1.jpg', // Remplacez par le chemin d'accès à l'image spécifique
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 2, // L'ID de la deuxième chaussure
                'image_chaussure' => 'AIR MAX 97 BLACK RED.jpg', // Remplacez par le chemin d'accès à l'image spécifique
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 3,
                'image_chaussure' => 'AIR MAX ESSENTIAL 95 BLACK.jpg', // Remplacez par le chemin d'accès à l'image spécifique
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 4,
                'image_chaussure' => 'CLASSIC XXI green.webp', // Remplacez par le chemin d'accès à l'image spécifique
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 5,
                'image_chaussure' => 'CLASSIC XXI red.webp', // Remplacez par le chemin d'accès à l'image spécifique
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 6,
                'image_chaussure' => 'SLIPSTREAM ARCHIVE green white.webp', // Remplacez par le chemin d'accès à l'image spécifique
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 7,
                'image_chaussure' => '2002-BEIGE.jpg', // Remplacez par le chemin d'accès à l'image spécifique
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 8,
                'image_chaussure' => '2002_BLACK.jpg', // Remplacez par le chemin d'accès à l'image spécifique
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 9,
                'image_chaussure' => 'MS327 BLACK WHITE.jpg', // Remplacez par le chemin d'accès à l'image spécifique
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 10,
                'image_chaussure' => 'CAMPUS 00S grey.jpg', // Remplacez par le chemin d'accès à l'image spécifique
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 11,
                'image_chaussure' => 'GAZELLE orange.jpg', // Remplacez par le chemin d'accès à l'image spécifique
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 12,
                'image_chaussure' => 'GAZELLE green.jpg', // Remplacez par le chemin d'accès à l'image spécifique
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Ajoutez d'autres entrées d'images pour d'autres chaussures
        ];

        DB::table('image_chaussures')->insert($images);
    }
}
