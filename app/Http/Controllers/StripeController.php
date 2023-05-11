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


        $adresse_id = $request->input('adresse_id');
        $adresses = Adresse::where('id_adresse', $adresse_id)->get();
        session(['adresses' => $adresses]);


        return view('stripe', [
            'items' => $items,
            'totalpanier' => $totalpanier
        ]);


    }

   //mise en place su moyen de payement
   public function stripePost(Request $request)
    {

        //le montant du panier et les chaussures
        $items = session('items');
        $adresses = session('adresses');
        $totalpanier = session('totalpanier');

        $id_adresse = $adresses->id_adresse;



        try {
            $stripe = new \Stripe\StripeClient(
                //ici je récupèrela ma clé privé qui est dans le env pour effectuer les payement en mode test
                env('STRIPE_SECRET')
            );
            $res = $stripe->tokens->create([
                //je recupere les infos mis par l'utilisateur
                'card' => [
                    'name' => $request->nomcarte,
                    //juste ici un petit x 100 car stripe n'accepte pas les double(float) donc on doit calculer en centimes
                    'number' => $request->number,
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                    'cvc' => $request->cvc,
                ],
            ]);

            \Stripe\stripe::setApiKey(env('STRIPE_SECRET'));
            //ici  stripe va vérifier si tout correspond
            $response = $stripe->charges->create([
                'amount' =>  $totalpanier * 100,
                'currency' => 'chf',
                'source' => $res->id,

            ]);

            //on récupère chaque chaussure pour stocker dans notre table commande et aussi pour enlever du stock le nombre x acheté par le client
            foreach($items as $item)
            {
                $user_id = auth()->user()->id;

                $id_chaussure = $item->id;
                $price = $item->price;
                $quantity = $item->quantity;
                $taille = $item->attributes->taille;
                $image = $item->attributes->image;
                $prixrabais = $item->attributes->prixrabais;

                //ici un peut compliqué je sais mais c'est juste pour récupèrer l'id stock pour pouvoir la stocker dans commande
                $id_stock = DB::table('stocks')
                ->join('tailles', 'stocks.id_taille', '=', 'tailles.id_taille')
                ->where('stocks.id_chaussure', $id_chaussure)
                ->where('tailles.taille', $taille)
                ->select('stocks.id_stock')
                ->first();
                //juste ici je fais ça car si je prends le id_stock de la requete il va me retourner du text et l id ce qui va créer une erreur pour mettre dans le champs id stock de commande
                $id_stock = $id_stock->id_stock;

                //ici on prends la quantité de chaussure acheté pour soustraire au nombre de stock dans la bd
                DB::table('stocks')->where('id_stock', $id_stock)->decrement('stock', $quantity);

                //creation commande
                $commande = Commande::create([
                    'id_utilisateur' => Auth::id(),
                    'id_stock' => $id_stock,
                    'montant' => $totalpanier,
                    'id_adresse' =>  $id_adresse,

                ]);
            }


            $shuffledCollection = Chaussure::all();

            //pour la page recherhece quand l'utilisateur ne trouve pas une chaussure en particulier, cette fonction va tirer des chaussures au hasard à lui montrer pour en faire des "suggestions"
            $listchaussures = $shuffledCollection->shuffle();

                 //afficher l'image de chaque chaussure qui est dans la liste à la vue
                 foreach ($listchaussures as $chaussure) {
                    $images = ImageChaussure::where('id_chaussure', $chaussure->id_chaussure)->get();
                    $chaussure->image = $images->first();
                }

            return view("success", ['listchaussures' => $listchaussures,]);
        }
        catch(\Stripe\Exception\CardException $ex) {
            $error = $ex->getError();
            $message = $error->message;
            Session::flash('stripe_error', $message);
            return redirect()->back();
        }

    }




}
