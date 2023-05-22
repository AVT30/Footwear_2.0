<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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
use App\Models\Adresse;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Whishlist;
use Illuminate\View\View;
use Cart;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function index()
    {
        $chaussures = Chaussure::orderBy('created_at', 'desc')->take(10)->get();

        foreach ($chaussures as $chaussure) {
            $images = ImageChaussure::where('id_chaussure', $chaussure->id_chaussure)->get();
            $chaussure->image = $images->first();

            // Calculer le rabais et le prix réduit pour chaque chaussure
            $rabais = Rabais::where('id_chaussure', $chaussure->id_chaussure)->where('expiration_rabais', '>', now())->first();

            $pourcentage = null;
            $prix = $chaussure->prix;

            if ($rabais) {
                $pourcentage = $rabais->rabais;
                $prixReduit = $prix - ($prix * $rabais->rabais / 100);
                $prix = $prixReduit;
            }

            // Assigner les valeurs correspondantes à chaque chaussure
            $chaussure->pourcentage = $pourcentage;
            $chaussure->prix = $prix;
        }

        return view('accueil', ['chaussures' => $chaussures]);
    }
}
