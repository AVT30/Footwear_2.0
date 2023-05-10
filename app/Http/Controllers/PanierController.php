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
use App\Models\Rabais;
use App\Models\Whishlist;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Cart;


class PanierController extends Controller
{

    public function add($id_chaussure, Request $request)
    {
        // Validate the user input
        $validator = Validator::make($request->all(), [
            'taille' => 'required',
            'quantity' => 'required|numeric|min:1',
        ]);

        // If the validation fails, redirect back to the form with errors
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // If the validation passes, add the item to the cart
        $chaussure = Chaussure::find($id_chaussure);

        //ici une foreach pour afficher l'image de chaque chaussure qui est dans la liste à la vue
        $images = ImageChaussure::where('id_chaussure', $chaussure->id_chaussure)->get();
        $image = $images->first();



        Cart::add(array(
            'id' => $chaussure->id_chaussure,
            'name' => $chaussure->modele,
            'price' => $chaussure->prix,
            'quantity' => $request->input('quantity'),
            'attributes' => array('taille' => $request->input('taille'),
                                    'image' => $image->image_chaussure,
                                    'pourcentage' => $request->input('pourcentage'),
                                    'prixrabais' => $request->input('prixrabais'))
        ));

        // Redirect to the cart page
        return redirect(route('panier'));
    }

    public function panier()
    {
        $items = Cart::getContent();
        $totalpanier = 0;

        // petit foreach pour faire un calcul du total final si la chaussure a un rabais, le total se fait en fonction du prix avec le rabais
        foreach($items as $item){
            $prix = $item->price;
            $prixRabais = $item->attributes->prixrabais;

            if($prixRabais != null){
                $totalpanier += $item->quantity * $prixRabais;
            } else {
                $totalpanier += $item->quantity * $prix;
            }
        }

        // Stocker les variables dans une session pour les utiliser après pour le payement
        session(['totalpanier' => $totalpanier, 'items' => $items]);

        return view('panier', [
            'items' => $items,
            'totalpanier' => $totalpanier
        ]);
    }

    public function supprimerArticle($id)
{
    Cart::remove($id);

    return redirect()->route('panier');
}
}
