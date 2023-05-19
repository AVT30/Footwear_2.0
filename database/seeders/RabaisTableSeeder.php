<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Rabais;
use Illuminate\Support\Facades\DB;

class RabaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ici avec la commande seed, tout va se remplir automatiquement
        $rabais = [
            [
                'id_chaussure' => 1, // L'ID de la première chaussure que vous avez insérée
                'rabais' => 50,
                //pour les dates des rabais
                'expiration_rabais' => Carbon::now()->addDays(7),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 6, // L'ID de la première chaussure que vous avez insérée
                'rabais' => 5,
                //pour les dates des rabais
                'expiration_rabais' => Carbon::now()->addDays(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 4, // L'ID de la première chaussure que vous avez insérée
                'rabais' => 35,
                //pour les dates des rabais
                'expiration_rabais' => Carbon::now()->addDays(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 8, // L'ID de la première chaussure que vous avez insérée
                'rabais' => 20,
                //pour les dates des rabais
                'expiration_rabais' => Carbon::now()->addDays(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 3, // L'ID de la première chaussure que vous avez insérée
                'rabais' => 75,
                //pour les dates des rabais
                'expiration_rabais' => Carbon::now()->addDays(9),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_chaussure' => 11, // L'ID de la première chaussure que vous avez insérée
                'rabais' => 40,
                //pour les dates des rabais
                'expiration_rabais' => Carbon::now()->addDays(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($rabais as $rabai) {
            DB::table('rabais')->insert($rabai);
        }
    }
}
