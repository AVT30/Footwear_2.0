<?php

namespace App\Models;

use App\Models\Utilisateur;
use App\Models\Pays;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    use HasFactory;

    //une adresse appartient a plusieurs utilisateurs (si c'est une famille etc)
    public function utilisateur()
    {
        return $this->hasMany(Utilisateur::class);
    }

    //une adresse n'appartient qu'a un seul pays
    public function pays()
    {
        return $this->belongsTo(pays::class);
    }
}
