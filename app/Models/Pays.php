<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pays';

    public function adresses()
    {
        return $this->hasMany(Adresse::class);
    }
}
