<?php

namespace App\Models;

use App\Models\Utilisateur;
use App\Models\Chaussures;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;

    public function utilisateur()
    {
        return $this->belongsTo(utilisateur::class);
    }

    public function chaussure()
    {
        return $this->belongsTo(Chaussures::class);
    }
}
