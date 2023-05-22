<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Avis;


class AvisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            {
                $avis = [
                    [
                        'commentaire' => "j'aime beucoup cette chaussure",
                        'etoile' =>  5,
                        "id_utilisateur" => 1,
                        "id_chaussure" => 1,
                        'isActive' => '0',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'commentaire' => "pas mal",
                        'etoile' =>  3,
                        "id_utilisateur" => 2,
                        "id_chaussure" => 7,
                        'isActive' => '0',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'commentaire' => "bonne matière",
                        'etoile' =>  1,
                        "id_utilisateur" => 1,
                        "id_chaussure" => 2,
                        'isActive' => '0',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'commentaire' => "Pas confortable du tout, a ne pas acheter",
                        'etoile' =>  2,
                        "id_utilisateur" => 4,
                        "id_chaussure" => 8,
                        'isActive' => '0',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'commentaire' => "Elle est niquel, tout est parfait sur cette chaussures elle merite 5 étoiles",
                        'etoile' =>  5,
                        "id_utilisateur" => 9,
                        "id_chaussure" => 3,
                        'isActive' => '0',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'commentaire' => "nul germain, nuuuuuuuuuuuuuuuuuuuuuuuuul",
                        'etoile' =>  1,
                        "id_utilisateur" => 6,
                        "id_chaussure" => 11,
                        'isActive' => '0',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'commentaire' => "c'est une matière de m****",
                        'etoile' =>  1,
                        "id_utilisateur" => 4,
                        "id_chaussure" => 1,
                        'isActive' => '0',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],

                ];

                DB::table('avis')->insert($avis);
        }
    }
}
