<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Taille;

class TaillesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Initialiser le tableau des tailles
        $tailles = [];

        // Générer les tailles de 30 à 50 avec des incréments de 0,5
        for ($i = 30; $i <= 50; $i += 0.5) {
            $tailles[] = [
                'taille' => number_format($i, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insérer les tailles dans la base de données
        DB::table('tailles')->insert($tailles);
    }
}
