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
use App\Models\Pays;
use App\Models\Adresse;
use App\Models\Whishlist;
use App\Models\user;
use Illuminate\View\View;
use Cart;


class AdresseController extends Controller
{
    // l'id dans l'argument est pour la chaussure
    public function adresse()
    {
        $user = Auth::user();
        $pays = Pays::all();

        $adresses = Adresse::where('id_utilisateur',  Auth::id())->get();


        return view('adresse', ['user' => $user, 'pays' => $pays, 'adresses' => $adresses]);
    }

    public function creationadresse(Request $request)
    {

        $adresse = new Adresse();
        $adresse->adresse = $request->input('adresse');
        $adresse->code_postal = $request->input('npa');
        $adresse->ville = $request->input('ville');
        $adresse->type_adresse = 1;
        $adresse->id_utilisateur = Auth::id();
        $adresse->id_pays = $request->pays;
        $adresse->save();

        $items = Cart::getContent();
        $totalpanier = 0;

        // petit foreach pour faire un calcul du total final si la chaussure a un rabais, le total se fait en fonction du prix avec le rabais
        foreach ($items as $item) {
            $prix = $item->price;
            $prixRabais = $item->attributes->prixrabais;

            //supprimer lettres
            $prixRabais = preg_replace('/[^0-9.]/', '', $prixRabais);

            if ($prixRabais != null) {
                $totalpanier += $item->quantity * $prixRabais;
            } else {
                $totalpanier += $item->quantity * $prix;
            }
        }

        // Passer les données de l'adresse à la vue
        return view('stripe', [
            'items' => $items,
            'totalpanier' => $totalpanier
        ]);
    }

    //pour supprimer une adresse
    public function destroy($id)
    {
        $adresse = Adresse::findOrFail($id);
        $adresse->delete();
        $remaining_addresses = Adresse::where('id_utilisateur', Auth::id())->count();

        if ($remaining_addresses == 0) {
            return redirect()->route('adresse')->with('success', 'L\'adresse a été supprimée avec succès. Veuillez ajouter une nouvelle adresse.');
        }
        return redirect()->back()->with('success', 'L\'adresse a été supprimée avec succès.');
    }
}
