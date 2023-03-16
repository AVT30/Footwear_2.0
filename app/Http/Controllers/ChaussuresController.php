<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Chaussure;
use App\Models\listTypeChaussures;
use App\Models\TypeChaussure;
use App\Models\ImageChaussure;
use Illuminate\View\View;

class ChaussuresController extends Controller
{
    public function chaussures($type)
    {
        $chaussures = Chaussure::all();


        //ici une foreach pour afficher l'image de chaque chaussure qui est dans la liste à la vue
        foreach ($chaussures as $chaussure) {
            $images = ImageChaussure::where('id_chaussure', $chaussure->id_chaussure)->get();
            $chaussure->image = $images->first();
        }

        //pour afficher la page de création de chaussure avec listtypechaussures pour attribuer la type à la chaussure
        $list_type_chaussures = listTypeChaussures::all();

        if (view()->exists('chaussures.' . $type)) {
            return view('chaussures.'.$type, [
                'chaussures' => $chaussures,
                'list_type_chaussures' => $list_type_chaussures,
            ]);
        } else {
            abort(404);
        }
    }

    public function show(Request $request)
    {
        //ici c'est pour afficher une chaussure un particulier si on clique sur sa carte
        $id = $request->id;

        $chaussure = Chaussure::findOrFail($id);

        if (view()->exists('chaussures.chaussure.show')) {
            return view('chaussures.chaussure.show', [
                'chaussure' => $chaussure,
            ]);
        } else {
            abort(404);
        }
    }


    public function creationchaussure(Request $request)
    {
        //pour afficher la page de création de chaussure avec listtypechaussures pour attribuer la type à la chaussure
        $list_type_chaussures = listTypeChaussures::all();

        return view('admin.creation',[
            'list_type_chaussures' => $list_type_chaussures
        ]);
    }

    public function creation(Request $request)
    {
        //création de la chaussure pour l'admin pour faciliter l'ajout
        $chaussure = Chaussure::create([
            'modele' => $request->input('modele'),
            'marque' => $request->input('marque'),
            'genre' => $request->input('genre'),
            'couleurP' => $request->input('couleurP'),
            'couleurS' => $request->input('couleurS'),
            'prix' => $request->input('prix'),
        ]);

        $idChaussure = $chaussure->id_chaussure;

        // Vérifier si une image a déjà été téléchargée pour cette chaussure
        $imageExists = ImageChaussure::where('id_chaussure', $idChaussure)->exists();
        if ($imageExists)
        {
            //ne marche pas encore mais un message d'erreur si l'image existe déjà
            $errorMessage = 'Une image existe déjà pour cette chaussure';
            return redirect()->back()->withErrors(['error' => $errorMessage]);
        }

        //un foreach si on décide de mettre plusieurs images à la chaussure
        foreach ($request->images as $image) {
            //le nom de l'image sera la date de l'enregistrement car c'est plus simple a gerer concernant les doublons etc
            $filename = time() . '.' . $image->extension();
            $path = $image->storeAs('public/images', $filename);

            //création de l'image avec les valeurs récupérés par la vue
            $imageChaussure = new ImageChaussure();
            $imageChaussure->id_chaussure = $idChaussure;
            $imageChaussure->image_chaussure = $filename;
            $imageChaussure->save();
        }

        //on récupere l'id de l'input type chaussure pour l'attribuer a la type type chaussure
        $idTypeChaussures = $request->input('type-chaussures');

        //on crée dans la table types chaussure la liason entre le type et la chaussre
        $typeChaussure = new TypeChaussure();
        $typeChaussure->id_chaussure = $idChaussure;
        $typeChaussure->id_list_types = $idTypeChaussures;
        $typeChaussure->save();

        // Redirection vers la page de détails de la chaussure créée
        return redirect()->route('chaussures.show', ['id' => $chaussure->id_chaussure]);
    }

}
