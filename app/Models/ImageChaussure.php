<?php

namespace App\Models;

use App\Models\Chaussures;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageChaussure extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_image_chaussure';
    protected $fillable = ['imagechaussure'];

    public function chaussure()
    {
        return $this->belongsTo(Chaussure::class);

    }
}
