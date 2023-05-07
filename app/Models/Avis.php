<?php

namespace App\Models;

use App\Models\User;
use App\Models\Chaussures;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;
    //pour indiquer a laravel que je vais remplir ces champs de valeurs
    protected $fillable = ['id_chaussure', 'etoile', 'commentaire', 'id_utilisateur'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }

    public function chaussure()
    {
        return $this->belongsTo(Chaussures::class);
    }
}
