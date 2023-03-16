<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TypeChaussure;

class listTypeChaussures extends Model
{
    use HasFactory;

    public function typeChaussure()
    {
        return $this->belongsTo(TypeChaussure::class);
    }

}
