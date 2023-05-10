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
use App\Models\Adresse;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Whishlist;
use Illuminate\View\View;
use Cart;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $items = Cart::getContent();
        $total = Cart::getTotal();


        $adresse_id = $request->input('adresse_id');
        $adresses = Adresse::where('id_adresse', $adresse_id)->get();

        return view('checkout', [
            'items' => $items,
            'total' => $total,
            'adresses' => $adresses,
        ]);
        //retour à la vu search avec ce que l'utilisateur demande



    }

    public function processPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $token = $request->input('stripeToken');
        $chargeAmount = 5000; // Montant en cents

        try {
            $charge = Charge::create([
                'amount' => $chargeAmount,
                'currency' => 'usd',
                'description' => 'Example Charge',
                'source' => $token,
            ]);

            // Le paiement a été effectué avec succès
            return redirect()->route('checkout.success')->with('success_message', 'Payment successful.');

        } catch (\Exception $e) {
            // Il y a eu une erreur lors du paiement
            return redirect()->back()->withErrors(['error_message' => $e->getMessage()]);
        }
    }

}
