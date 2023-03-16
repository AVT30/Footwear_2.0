<?php

namespace App\Models;

use App\Models\Avis;
use App\Models\Rabais;
use App\Models\Panier;
use App\Models\Taille;
use App\Models\ImageChaussure;
use App\Models\Commande;
use App\Models\TypeChaussure;
use App\Models\listTypeChaussures;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chaussure extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_chaussure';

    //pour indiquer a laravel que je vais remplir ces champs de valeurs
    protected $fillable = ['modele', 'marque', 'genre', 'couleurP', 'couleurS', 'prix'];

    public function imagesChaussures()
    {
        return $this->hasMany(ImageChaussure::class, 'id_chaussure');
    }

    public function typeChaussure()
    {
        return $this->hasOneThrough(
            TypeChaussure::class,
            listTypeChaussures::class,
            'id_chaussure',
            'id_list_types',
            'id_chaussure',
            'id_list_types'
        );
    }

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


    public function commande()
    {
        return $this->hasMany(Commande::class);
    }

}
