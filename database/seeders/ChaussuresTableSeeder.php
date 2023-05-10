<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Chaussure;
use Illuminate\Support\Facades\DB;

class ChaussuresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chaussures = [
            [
                'modele' => 'Air Max 90',
                'marque' => 'Nike',
                'genre' => 'Homme',
                'couleurP' => 'Blanc',
                'couleurS' => 'Noir',
                'prix' => 99.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'modele' => 'Air jordan 1',
                'marque' => 'Nike',
                'genre' => 'Femme',
                'couleurP' => 'Blanc',
                'couleurS' => 'Bleu',
                'prix' => 79.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'modele' => 'Adidas performance',
                'marque' => 'Adidas',
                'genre' => 'Femme',
                'couleurP' => 'Blanc',
                'couleurS' => 'Noir',
                'prix' => 64.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($chaussures as $chaussure) {
            DB::table('chaussures')->insert($chaussure);
        }
    }
}
