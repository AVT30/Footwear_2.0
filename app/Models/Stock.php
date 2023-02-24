<?php

namespace App\Models;

use App\Models\Panier;
use App\Models\Chaussure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    public function panier()
    {
        return $this->belongsToMany(Panier::class);
    }

    public function chaussure()
    {
        return $this->belongsToMany(Chaussure::class);
    }

}
