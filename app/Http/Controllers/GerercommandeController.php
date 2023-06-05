<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;

class GerercommandeController extends Controller
{
    //afficher tous les utilisatuers dans le tableau
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

}
