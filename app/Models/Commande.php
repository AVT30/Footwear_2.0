<?php

namespace App\Models;

use App\Models\User;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = ['id_utilisateur', 'id_stock'];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }

    public function stock()
    {
        return $this->hasMany(Stock::class, 'id_chaussure');
    }

    public function chaussure()
    {
     return $this->belongsTo(Chaussure::class, 'id_chaussure');
    }
}
