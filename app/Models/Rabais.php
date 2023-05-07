<?php

namespace App\Models;

use App\Models\Chaussures;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rabais extends Model
{
    use HasFactory;

    protected $fillable = ['id_chaussure', 'rabais', 'expiration_rabais'];
    // ...

    public function chaussures()
    {
        return $this->belongsToMany(Chaussure::class, 'rabais', 'id_rabais', 'id_chaussure');
    }
}
