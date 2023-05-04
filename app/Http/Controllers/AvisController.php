<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Chaussure;
use App\Models\listTypeChaussures;
use App\Models\TypeChaussure;
use App\Models\Taille;
use App\Models\ImageChaussure;
use App\Models\Stock;
use App\Models\Whishlist;
use Illuminate\View\View;

class AvisController extends Controller
{
    public function avis(Request $request)
{
    // Validation des champs du formulaire
    $validatedData = $request->validate([
    'id_chaussure' => 'required|integer',
    'message' => 'required|string|max:255',
    'rating' => 'required|integer|min:1|max:5'
    ]);

    $id_chaussure = $request->input('id_chaussure');
    $rating = $request->input('rating');
    $message = $request->input('message');

    // Enregistrer l'avis dans la base de données, etc.

    dd($validatedData);

    return redirect()->back()->with('success', 'Merci pour votre avis !');
}

}
