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
use App\Models\Commande;
use App\Models\Avis;
use App\Models\ImageChaussure;
use App\Models\Stock;
use App\Models\Pays;
use App\Models\Adresse;
use App\Models\Whishlist;
use App\Models\user;
use Illuminate\View\View;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Illuminate\Support\Facades\Validator;
use Cart;
use Illuminate\Support\Facades\Session;


class StripeController extends Controller
{
    public function stripe(Request $request)
    {
        //ici le sessions pour récupèrer tout le nécessaire pour le payment
        $items = session('items');
        $totalpanier = session('totalpanier');
        $adresse = session('adresse');

        $id_adresse = $request->input('id_adresse');
        $adresses = Adresse::where('id_adresse', $id_adresse)->get();
        session(['adresses' => $adresses]);

        return view('stripe', [
            'items' => $items,
            'totalpanier' => $totalpanier
        ]);
    }

    public function stripePost(Request $request)
    {
        // Le montant du panier et les chaussures
        $items = session('items');
        $adresses = session('adresses');
        $totalpanier = session('totalpanier');


        // Un petit if pour savoir s'il a créé une adresse ou s'il a sélectionné une déjà créée
        if ($adresses != null) {
            $id_adresse = null;
            foreach ($adresses as $adresse) {
                $id_adresse = $adresse->id_adresse;
            }
        } else {
            $id_adresse = $request->input('id_adresse');
        }

        try {
            // Code de paiement avec Stripe

            // Vérification du nombre de commandes existantes
            $nombreCommandes = DB::table('commandes')->count();
            // Si le nombre de commandes est 0, la première commande portera le numéro 1
            if ($nombreCommandes == 0) {
                $numeroCommande = 1;
            } else {
                // Récupération de la dernière commande pour ajouter 1 au numéro de commande
                $derniereCommande = DB::table('commandes')->orderBy('id_commande', 'desc')->first();
                $numeroCommande = $derniereCommande->numero_commande + 1;
            }

            // On récupère chaque chaussure pour la stocker dans notre table commande et mettre à jour le stock
            foreach ($items as $item) {
                $user_id = auth()->user()->id;

                $id_chaussure = $item->id;
                $price = $item->price;
                $quantity = $item->quantity;
                $taille = $item->attributes->taille;
                $image = $item->attributes->image;
                $prixrabais = $item->attributes->prixrabais;

                // Ici, on récupère l'id_stock pour le stocker dans la table commande
                $id_stock = DB::table('stocks')
                    ->join('tailles', 'stocks.id_taille', '=', 'tailles.id_taille')
                    ->where('stocks.id_chaussure', $id_chaussure)
                    ->where('tailles.taille', $taille)
                    ->select('stocks.id_stock')
                    ->first();
                $id_stock = $id_stock->id_stock;

                // Ici, on met à jour le stock en soustrayant la quantité de chaussures achetées
                DB::table('stocks')->where('id_stock', $id_stock)->decrement('stock', $quantity);

                // Création de la commande
                DB::table('commandes')->insert([
                    'id_utilisateur' => Auth::id(),
                    'id_stock' => $id_stock,
                    'montant' => $totalpanier,
                    'id_adresse' => $id_adresse,
                    'id_chaussure' => $id_chaussure,
                    'numero_commande' => $numeroCommande,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Code pour vider le panier une fois l'achat éffectué
            Cart::clear();

            $shuffledCollection = Chaussure::all();

            // Pour la page recherche, cette fonction va récupérer des chaussures au hasard pour les afficher en suggestions
            $listchaussures = $shuffledCollection->shuffle()->take(8);

            //afficher l'image de chaque chaussure qui est dans la liste à la vue
            foreach ($listchaussures as $chaussure) {
                $images = ImageChaussure::where('id_chaussure', $chaussure->id_chaussure)->get();
                $chaussure->image = $images->first();
            }

            return view("success", ['listchaussures' => $listchaussures,]);
        } catch (\Stripe\Exception\CardException $ex) {
            $error = $ex->getError();
            $message = $error->message;
            Session::flash('stripe_error', $message);
            return redirect()->back();
        }
    }
}
