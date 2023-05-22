<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Chaussure;
use App\Models\ImageChaussure;
use Illuminate\View\View;


class SearchController extends Controller
{
    public function search(Request $request)
    {   //variable qui contient la valeur que l'utilisateur à inscrit dans la barre de recherche
        $query = $request->input('query');

        $shuffledCollection = Chaussure::all();


        //pour la page recherhece quand l'utilisateur ne trouve pas une chaussure en particulier, cette fonction va tirer des chaussures au hasard à lui montrer pour en faire des "suggestions"
        $listchaussures = $shuffledCollection->shuffle()->take(8);

        $chaussures = [];
        //ce code va essayer de chercher la valeur qui correspond à la demande de l'utilisateur
        $chaussures = DB::table('chaussures')
            ->where('modele', 'like', "%$query%")
            ->orWhere('marque', 'like', "%$query%")
            ->orWhere('genre', 'like', "%$query%")
            ->orWhere('couleurP', 'like', "%$query%")
            ->orWhere('couleurS', 'like', "%$query%")
            ->get();

        //afficher l'image de chaque chaussure qui est dans la liste à la vue
        foreach ($chaussures as $chaussure) {
            $images = ImageChaussure::where('id_chaussure', $chaussure->id_chaussure)->get();
            $chaussure->image = $images->first();
        }

        //afficher l'image de chaque chaussure qui est dans la liste à la vue
        foreach ($listchaussures as $chaussure) {
            $images = ImageChaussure::where('id_chaussure', $chaussure->id_chaussure)->get();
            $chaussure->image = $images->first();
        }

        //retour à la vu search avec ce que l'utilisateur demande
        return view('search', ['chaussures' => $chaussures, 'listchaussures' => $listchaussures,], compact('query'));
    }
}
