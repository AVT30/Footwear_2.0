<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Pays;

class PaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pays = json_decode(file_get_contents(database_path('pays.json')), true);

        // Boucle à travers chaque pays et ajoute-le à la base de données
        foreach ($pays as $p) {
            DB::table('pays')->insert([
                'pays' => $p['country'],
                'code' => $p['abbreviation'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
