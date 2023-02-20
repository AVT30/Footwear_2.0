<?php

namespace App\Models;

use App\Models\Utilisateur;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
