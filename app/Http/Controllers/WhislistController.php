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

class WhislistController extends Controller
{
    public function whislist()
    {
        $whislist = Whishlist::all();


        //j'ai du faire cette requete sql pour recuperer les chaussures par l'id a travers la table stock. j'ai fait cette methode pour ne pas devoir refaire un migrate et ainsi perdre les données
        $chaussures = DB::table('chaussures')
            ->join('wishlists', 'chaussures.id_chaussure', '=', 'wishlists.id_chaussure')
            ->select('*')
            ->where('wishlists.id_utilisateur', Auth::id())
            ->get();

        // //ici une foreach pour afficher l'image de chaque chaussure qui est dans la liste à la vue
        foreach ($chaussures as $chaussure) {
            $images = ImageChaussure::where('id_chaussure', $chaussure->id_chaussure)->get();
            $chaussure->image = $images->first();
        }

        return view('whislist', [
            'whislist' => $whislist,
            'chaussures' => $chaussures,
        ]);
    }

    public function ajoutwhislist(Request $request)
    {
        $idchaussure = $request->id;


        $wishlist = new Whishlist();
        $wishlist->id_chaussure = $idchaussure;
        $wishlist->id_utilisateur = Auth::id(); // Ajouter l'ID de l'utilisateur connecté à la wishlist
        $wishlist->save();

        return back()->with('success', 'Le produit a été ajouté à la liste de souhaits.');
    }

    public function supprimerwhislist(Request $request)
    {
        $idChaussure = $request->id;

        // Trouver la relation correspondante dans la table wishlist
        $wishlist = DB::table('wishlists')
            ->where('id_chaussure', $idChaussure)
            ->where('id_utilisateur', Auth::id())
            ->first();

        // Supprimer la relation si elle existe
        if ($wishlist) {
            DB::table('wishlists')->where('id_wishlist', $wishlist->id_wishlist)->delete();
        }
        //on retourne sur la page avec les chaussures
        return back()->with('success', 'Le produit a été ajouté à la liste de souhaits.');
    }
}
