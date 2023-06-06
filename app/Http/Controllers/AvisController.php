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
    public function avisuser(Request $request, $id)
    {

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

    public function avis()
    {

        //on récupère les avis //si jamais j'ai mis un isactive 0 de base mais les avis s'affichent quand meme car c'est plus facile pour trier dans la page pour gerer les avis qui est dans gerer utilisateurs
        $avisusers = Avis::where('isActive', false)->orderBy('created_at', 'desc')->paginate(3);

        return view('gereravis', [
            'avisusers' => $avisusers,
        ]);
    }
    //Activer les avis qui sont mis en attente,
    public function accepterAvis($id)
    {

        $avis = Avis::find($id);
        if ($avis) {
            $avis->isActive = 1;
            $avis->save();
        }
        return redirect()->back();
    }

    public function supprimerAvis($id)
    {
        $avis = Avis::find($id);

        if ($avis) {
            $avis->delete();
        }

        return redirect()->back();
    }
}
