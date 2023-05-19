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
use App\Models\Rabais;
use App\Models\Stock;
use App\Models\Avis;
use App\Models\Commande;
use Illuminate\View\View;

class CommandeController extends Controller
{
    public function commandes()
    {
       // Récupère l'utilisateur connecté
        $user = Auth::user();

        // Régroupe chaque commande par son numéro de commande
        $chaussuresParCommande = $user->commandes()->with('stock.chaussure')->get()->groupBy('numero_commande');

        $user = Auth::user();

        // Régroupe chaque commande par son numéro de commande
        $chaussuresParCommande = $user->commandes()->get()->groupBy('numero_commande');

        foreach ($chaussuresParCommande as $numeroCommande => $commandes) {
            foreach ($commandes as $commande) {
                // Récupérer la chaussure via l'id de la chaussure dans la commande
                $chaussure = Chaussure::findOrFail($commande->id_chaussure);

                // Récupérer l'image de la chaussure
                $images = ImageChaussure::where('id_chaussure', $chaussure->id_chaussure)->get();
                $chaussure->image = $images->first();

                // Calculer le rabais et le prix réduit pour chaque chaussure
                $rabais = Rabais::where('id_chaussure', $chaussure->id_chaussure)
                    ->where('expiration_rabais', '>', now())
                    ->first();

                $pourcentage = null;
                $prix = $chaussure->prix;

                if ($rabais) {
                    $pourcentage = $rabais->rabais;
                    $prixReduit = $prix - ($prix * $rabais->rabais / 100);
                    $prix = $prixReduit;
                }

                // Assigner les valeurs correspondantes à chaque chaussure
                $chaussure->pourcentage = $pourcentage;
                $chaussure->prixReduit = $prix;
            }
        }



        return view('commandes', [
            'chaussuresParCommande' => $chaussuresParCommande,
        ]);
    }
}
