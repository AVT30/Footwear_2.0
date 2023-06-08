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
use App\Models\User;
use App\Models\Adresse;
use App\Models\Stock;
use App\Models\Avis;
use App\Models\Commande;
use Illuminate\View\View;
use PDF;

class CommandeController extends Controller
{
    public function commandes()
    {
        // Récupère l'utilisateur connecté
        $user = Auth::user();

        // Régroupe chaque commande par son numéro de commande (on fait un desc pour afficher les dernières commandes faites par l'utilisateur)
        $chaussuresParCommande = $user->commandes()->with('stock.chaussure')->orderBy('created_at', 'desc')->get()->groupBy('numero_commande');

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


        session(['chaussuresParCommande' => $chaussuresParCommande]);
        return view('commandes', [
            'chaussuresParCommande' => $chaussuresParCommande,
        ]);
    }

    public function gerercommande()
    {
        $commandes = Commande::all();

        $commandesPerPage = 5; // Nombre d'utilisateurs par page

        $commandes = Commande::paginate($commandesPerPage); //pour l'affichage limité d'utilisateur de 5 par tableau


        return view('gerercommande', [
            'commandes' => $commandes,
        ]);
    }

    //on change le statu de la commande
    public function update(Request $request, $id)
    {
        $commande = Commande::findOrFail($id);
        $commande->status = $request->input('status');
        $commande->save();

        return redirect()->back()->with('success', 'Statut de la commande mis à jour avec succès !');
    }

    //fonction qui servira a la création du pdf de la commande
    public function genererPDF($numeroCommande)
    {
        // Récupérer la liste des commandes avec le numéro de commande donné
        $commandes = Commande::where('numero_commande', $numeroCommande)->get();

        // Récupérer l'adresse et l'utilisateur associés à la première commande car toutes les commandes de la liste ont en commun la meme adresse et utilisateur
        $premiereCommande = $commandes->first();
        $adresse = Adresse::find($premiereCommande->id_adresse);
        $utilisateur = User::find($premiereCommande->id_utilisateur);
        $datecommande = $premiereCommande->created_at;

        $montant = $commandes->sum('montant');


        // Contenu du PDF qu'on peut modifier dans pdf.blade.php
        $contenu = view('pdf', compact('commandes', 'adresse', 'utilisateur', 'montant', 'numeroCommande', 'datecommande'))->render();

        // La vue PDF blade sera reconvertie en PDF
        $pdf = PDF::loadHtml($contenu);

        return $pdf->stream('commande_' . $numeroCommande . '.pdf');
    }


}
