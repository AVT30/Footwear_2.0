<?php

namespace App\Models;

use App\Models\Chaussures;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeChaussure extends Model
{
    use HasFactory;



    public function chaussure()
    {
        return $this->hasMany(Chaussures::class, 'id_chaussure');
    }

    public function listTypeChaussure()
    {
        return $this->hasMany(ListTypeChaussure::class, 'id_list_types');
    }

}
