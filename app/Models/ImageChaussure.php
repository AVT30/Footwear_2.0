<?php

namespace App\Models;

use App\Models\Chaussures;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageChaussure extends Model
{
    use HasFactory;

    public function chaussure()
    {
        return $this->belongsTo(Chaussure::class);
    }
}
