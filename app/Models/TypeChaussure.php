<?php

namespace App\Models;

use App\Models\Chaussures;
use App\Models\listTypeChaussures;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeChaussure extends Model
{
    use HasFactory;


    protected $table = 'type_chaussures';

    public function listTypeChaussure()
    {
        return $this->hasMany(listTypeChaussures::class, 'id_list_types');
    }

    public function chaussure()
    {
        return $this->hasMany(Chaussures::class, 'id_chaussure');
    }

}
