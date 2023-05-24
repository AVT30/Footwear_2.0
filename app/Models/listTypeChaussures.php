<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Chaussure;

class listTypeChaussures extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_list_types';

    public function chaussure()
    {
        return $this->hasMany(Chaussure::class);
    }

}
