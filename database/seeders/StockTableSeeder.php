<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Chaussure;
use App\Models\Taille;
use Illuminate\Support\Facades\DB;

class StockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stocks = [];

        // Récupérer toutes les chaussures depuis votre source de données
        $chaussures = Chaussure::all(); // Remplacez "Chaussure" par le nom de votre modèle pour la table "chaussure"

        foreach ($chaussures as $chaussure) {
            $tailles = Taille::pluck('id_taille')->toArray(); // Remplacez "Taille" par le nom de votre modèle pour la table "taille"

            foreach ($tailles as $taille) {
                $stocks[] = [
                    'id_chaussure' => $chaussure->id_chaussure,
                    'id_taille' => $taille,
                    'stock' => 200,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insérez les données dans la table "seeders" en utilisant Eloquent ou Query Builder



        DB::table('stocks')->insert($stocks);
    }
}
