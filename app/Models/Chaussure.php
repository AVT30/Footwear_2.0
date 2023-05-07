<?php

namespace App\Models;

use App\Models\Avis;
use App\Models\Rabais;
use App\Models\Panier;
use App\Models\Taille;
use App\Models\ImageChaussure;
use App\Models\Commande;
use App\Models\TypeChaussure;
use App\Models\Stock;
use App\Models\Whishlist;
use App\Models\listTypeChaussures;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chaussure extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_chaussure';

    //pour indiquer a laravel que je vais remplir ces champs de valeurs
    protected $fillable = ['modele', 'marque', 'genre', 'couleurP', 'couleurS', 'prix'];

    public function images()
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
        return $this->hasMany(Avis::class, 'id_chaussure');
    }

    public function wishlists()
    {
        return $this->hasMany(Whishlist::class, 'id_chaussure');
    }

    public function rabais()
    {
        return $this->belongsToMany(Rabais::class, 'rabais', 'id_chaussure', 'id_rabais');
    }

    public function panier()
    {
        return $this->hasMany(Panier::class);
    }

    public function taille()
    {
        return $this->belongsToMany(Taille::class);
    }

    public function stock()
    {
        return $this->hasManyThrough(Stock::class, Taille::class, 'id_chaussure', 'id_taille');
    }

    public function commande()
    {
        return $this->hasMany(Commande::class);
    }

}
