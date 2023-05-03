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
use App\Models\Whishlist;
use Illuminate\View\View;
use Cart;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $items = Cart::getContent();
        $total = Cart::getTotal();


        return view('checkout', [
            'items' => $items,
            'total' => $total
        ]);
        //retour à la vu search avec ce que l'utilisateur demande



    }

}
