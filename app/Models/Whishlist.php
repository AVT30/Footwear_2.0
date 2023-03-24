<?php

namespace App\Models;

use App\Models\User;
use App\Models\Chaussure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whishlist extends Model
{
    use HasFactory;
    // Spécifier le nom de la table
    protected $table = 'wishlists';

    protected $primaryKey = 'id_wishlist';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chaussure()
    {
        return $this->hasMany(Chaussure::class);
    }


}
