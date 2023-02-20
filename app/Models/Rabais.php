<?php

namespace App\Models;

use App\Models\Chaussures;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rabais extends Model
{
    use HasFactory;

    public function chaussure()
    {
        return $this->hasMany(Chaussures::class);
    }
}
