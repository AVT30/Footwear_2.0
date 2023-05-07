<?php

namespace App\Models;

use App\Models\User;
use App\Models\Pays;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_adresse';

     //pour indiquer a laravel que je vais remplir ces champs de valeurs
     protected $fillable = ['id_pays', 'adresse', 'code_postal', 'ville'];



    //une adresse appartient a plusieurs utilisateurs (si c'est une famille etc)
    public function user()
    {
        return $this->hasMany(User::class);
    }

    //une adresse n'appartient qu'a un seul pays
    public function pays()
    {
        return $this->belongsTo(Pays::class, 'id_pays');
    }
}
