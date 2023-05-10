<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'id_list_type' => 2, // L'ID du deuxième type de chaussures que vous avez inséré (Sneakers basses)
            ],
            // Ajoutez ici les autres relations que vous souhaitez insérer dans la table
        ];

        DB::table('type_chaussures')->insert($type_chaussures);
    }
}
