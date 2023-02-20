<?php

namespace App\Models;

use App\Models\Adresse;
use App\Models\Avis;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;

    //Un utilisateur peut avoir plusieurs adresses
    public function adresses()
    {
        return $this->hasMany(Adresse::class);
    }

    //Un utilisateur peut avoir plusieurs avis
    public function avis()
    {
        return $this->hasMany(Avis::class);
    }
}
