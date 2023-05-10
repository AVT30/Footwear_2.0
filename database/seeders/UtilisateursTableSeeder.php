<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class UtilisateursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ici avec la commande seed, tout va se remplir automatiquement
        $users = [
            [
                'nom' => 'Rogeiro',
                'prenom' => 'Angelo',
                'email' => 'angelo.rogeiro@eduvaud.ch',
                'genre' => 'homme',
                'role' => 'admin',
                'password' => bcrypt('arogeiro'),
                'isActive' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'test',
                'prenom' => 'machiavelique',
                'email' => 'test.machiavelique@eduvaud.ch',
                'genre' => 'homme',
                'role' => 'user',
                'password' => bcrypt('testtest'),
                'isActive' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }

}
