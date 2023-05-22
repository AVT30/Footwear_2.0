<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Chaussure;
use App\Models\listTypeChaussures;
use App\Models\TypeChaussure;
use App\Models\Taille;
use App\Models\ImageChaussure;
use App\Models\Rabais;
use App\Models\Stock;
use App\Models\Avis;
use App\Models\User;
use Illuminate\View\View;

class GererAvisController extends Controller
{
    //afficher tous les utilisatuers dans le tableau
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
