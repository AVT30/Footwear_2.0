<?php

namespace App\Models;

use App\Models\Chaussures;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taille extends Model
{
    use HasFactory;

    public function chaussure()
    {
        return $this->belongsToMany(Chaussure::class);
    }
}
