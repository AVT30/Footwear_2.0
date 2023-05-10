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
            ],
            [
                'modele' => 'Classic Leather',
                'marque' => 'Reebok',
                'genre' => 'Femme',
                'couleurP' => 'Rose',
                'couleurS' => 'Blanc',
                'prix' => 79.99,
            ],
            [
                'modele' => 'Old Skool',
                'marque' => 'Vans',
                'genre' => 'Femme',
                'couleurP' => 'Noir',
                'couleurS' => 'Blanc',
                'prix' => 64.99,
            ],
        ];

        foreach ($chaussures as $chaussure) {
            DB::table('chaussures')->insert($chaussure);
        }
    }
}
