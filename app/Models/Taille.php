<?php

namespace App\Models;

use App\Models\Chaussure;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taille extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_taille';

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'id_chaussure');
    }
}
