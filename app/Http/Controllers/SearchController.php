<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Chaussure;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function search(Request $request)
    {   //variable qui contient la valeur que l'utilisateur à inscrit dans la barre de recherche
        $query = $request->input('query');

        $chaussures = [];
        //ce code va essayer de chercher la valeur qui correspond à la demande de l'utilisateur
        $chaussures = DB::table('chaussures')
            ->where('modele', 'like', "%$query%")
            ->orWhere('marque', 'like', "%$query%")
            ->orWhere('genre', 'like', "%$query%")
            ->orWhere('couleurP', 'like', "%$query%")
            ->orWhere('couleurS', 'like', "%$query%")
            ->get();

        // $posts = Chaussure::where('marque', 'like', '%'.$query.'%')->get();

        //retour à la vu search avec ce que l'utilisateur demande
        return view('search', ['chaussures' => $chaussures], compact('query'));
    }
}
