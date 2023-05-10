<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\listTypeChaussures;
use Illuminate\Support\Facades\DB;

class listTypeChaussure extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    $types = [
        ['type_chaussures' => 'Sneakers hautes'],
        ['type_chaussures' => 'Sneakers basses'],
        ['type_chaussures' => 'Sneakers de skate'],
        ['type_chaussures' => 'Chaussures de course'],
        ['type_chaussures' => 'Chaussures de Tennis'],
        ['type_chaussures' => 'Chaussures de Tennis'],
        ['type_chaussures' => 'Chaussures de Tennis'],
        ['type_chaussures' => 'Bottes'],
        ['type_chaussures' => 'Sandales'],
        ['type_chaussures' => 'Chaussures habillées'],
    ];

    DB::table('list_type_chaussures')->insert($types);
}

}
