<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_chaussures = [
            [
                'id_chaussure' => 1, // L'ID de la première chaussure que vous avez insérée
                'id_list_types' => 2, // L'ID du deuxième type de chaussures que vous avez inséré (Sneakers basses)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 2, // L'ID de la première chaussure que vous avez insérée
                'id_list_types' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 3, // L'ID de la première chaussure que vous avez insérée
                'id_list_types' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 4, // L'ID de la première chaussure que vous avez insérée
                'id_list_types' => 2, // L'ID du deuxième type de chaussures que vous avez inséré (Sneakers basses)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 5, // L'ID de la première chaussure que vous avez insérée
                'id_list_types' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 6, // L'ID de la première chaussure que vous avez insérée
                'id_list_types' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 7, // L'ID de la première chaussure que vous avez insérée
                'id_list_types' => 2, // L'ID du deuxième type de chaussures que vous avez inséré (Sneakers basses)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 8, // L'ID de la première chaussure que vous avez insérée
                'id_list_types' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 9, // L'ID de la première chaussure que vous avez insérée
                'id_list_types' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 10, // L'ID de la première chaussure que vous avez insérée
                'id_list_types' => 2, // L'ID du deuxième type de chaussures que vous avez inséré (Sneakers basses)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 11, // L'ID de la première chaussure que vous avez insérée
                'id_list_types' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 12, // L'ID de la première chaussure que vous avez insérée
                'id_list_types' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('type_chaussures')->insert($type_chaussures);
    }
}
