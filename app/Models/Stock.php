<?php

namespace App\Models;

use App\Models\Panier;
use App\Models\Chaussure;
use App\Models\Taille;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['id_taille', 'id_chaussure', ];

    protected $primaryKey = 'id_stock';

    public function chaussure()
    {
        return $this->hasMany(Chaussure::class, 'id_chaussure', 'id_chaussure');
    }

    public function taille()
    {
        return $this->hasMany(Taille::class, 'id_taille', 'id_taille');
    }

}
