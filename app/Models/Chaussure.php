<?php

namespace App\Models;

use App\Models\Avis;
use App\Models\Rabais;
use App\Models\Panier;
use App\Models\Taille;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chaussure extends Model
{
    use HasFactory;

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function rabais()
    {
        return $this->belongsTo(Rabais::class);
    }

    public function panier()
    {
        return $this->hasMany(Panier::class);
    }

    public function taille()
    {
        return $this->belongsToMany(Taille::class);
    }
}
