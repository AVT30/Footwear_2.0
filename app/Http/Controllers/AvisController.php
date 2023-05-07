<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Chaussure;
use App\Models\listTypeChaussures;
use App\Models\TypeChaussure;
use App\Models\Taille;
use App\Models\Avis;
use App\Models\ImageChaussure;
use App\Models\Stock;
use App\Models\Whishlist;
use App\Models\user;
use Illuminate\View\View;


class AvisController extends Controller
{
    // l'id dans l'argument est pour la chaussure
    public function avisuser(Request $request, $id) {

        // Vérifier le captcha
        $request->validate([
            'captcha' => 'required|captcha'
        ]);

        // Créer un nouvel avis
        $avis = new Avis();
        $avis->id_chaussure = $id;
        $avis->etoile = $request->input('rating');
        $avis->commentaire = $request->input('message');
        $avis->id_utilisateur = Auth::id();
        $avis->save();
        // Rediriger l'utilisateur vers la page de la chaussure
        return redirect()->back()->with('success', 'Votre avis a bien été ajouté.');
    }

}


