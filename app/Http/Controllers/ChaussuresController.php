<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Chaussure;
use App\Models\listTypeChaussures;
use App\Models\TypeChaussure;
use App\Models\Taille;
use App\Models\ImageChaussure;
use App\Models\Rabais;
use App\Models\Stock;
use App\Models\Avis;
use Illuminate\View\View;

class ChaussuresController extends Controller
{
    public function chaussures($type)
    {
        $chaussures = Chaussure::join('type_chaussures', 'chaussures.id_chaussure', '=', 'type_chaussures.id_chaussure')
                    ->join('list_type_chaussures', 'type_chaussures.id_list_types', '=', 'list_type_chaussures.id_list_types')
                    ->select('chaussures.*', 'list_type_chaussures.type_chaussures')
                    ->get();

        //melange les cahssures afin d'afficher une liste de chaussures au hasard
         $type_slug = strtolower(str_replace(" ", "-", $type));

        //ici une foreach pour afficher l'image de chaque chaussure qui est dans la liste à la vue
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



        //pour afficher la page de création de chaussure avec listtypechaussures pour attribuer le type à la chaussure
        $list_type_chaussures = listTypeChaussures::all();

        if (view()->exists('chaussures.' . $type_slug)) {
            return view('chaussures.'.$type_slug, [
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

        //afficher l'image de chaque chaussure qui est dans la liste à la vue
        $images = ImageChaussure::where('id_chaussure', $id)->get();
        $chaussure->image = $images->first();

        // Récupérer les avis pour cette chaussure
        $avis = Avis::with('user')->where('id_chaussure', $id)->get();

        // Calculer la moyenne des étoiles et le total des commentaires  pour cette chaussure
        $totalEtoiles = 0;
        $totalAvis = $avis->count();
        foreach ($avis as $avisItem) {
            $totalEtoiles += $avisItem->etoile;
        }
        $moyenneEtoiles = $totalEtoiles / ($totalAvis ?: 1);

        // Récupérer le rabais pour cette chaussure s'il y en a un et en fonction de la date
        $rabais = Rabais::where('id_chaussure', $id)->where('expiration_rabais', '>', now())->first();

        // Calculer le prix en prenant en compte le rabais s'il y en a un
        $pourcentage = null;
        $prix = $chaussure->prix;
        if ($rabais) {
            $pourcentage = $rabais->rabais;
            $prixReduit = $prix - ($prix * $rabais->rabais / 100);
            $prix = $prixReduit;
        }

        // Retourner la vue correspondante avec les données nécessaires
        return view('chaussures.chaussure.show', [
            'chaussure' => $chaussure,
            'avis' => $avis,
            'prix' => $prix, // passer le prix calculé à la vue et s'il n'y a pas de rabais ca affiche le prix de base
            'pourcentage' => $pourcentage,
            'moyenneEtoiles' => $moyenneEtoiles,
            'totalAvis' => $totalAvis
        ]);
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

        //ici on va faire que pour la chaussure, un nombre de 200 paires par taille soit stocké dans la table stock
        $tailles = Taille::all();

        //foreach pour que pour chaque taille il y ai une création
        foreach ($tailles as $taille) {
            $stock = new Stock;
            $stock->id_taille = $taille->id_taille;
            $stock->id_chaussure = $idChaussure;
            $stock->save();
        }

        //création du rabais
        $pourcentageRabais = $request->input('rabais');
        $daterabaisexpiration = $request->input('date');

        // Si le rabais n'est pas vide et est un nombre entre 5 et 75 inclus
        if (!empty($pourcentageRabais) && $pourcentageRabais >= 5 && $pourcentageRabais <= 75) {
            // On crée une nouvelle réduction pour la chaussure
            $rabais = new Rabais();
            $rabais->id_chaussure = $idChaussure;
            $rabais->rabais = $pourcentageRabais;
            $rabais->expiration_rabais = $daterabaisexpiration; // Date d'expiration du rabais
            $rabais->save();
        }


        // Redirection vers la page de détails de la chaussure créée
        return redirect()->route('chaussures.show', ['id' => $chaussure->id_chaussure]);
    }

    public function modification()
    {
        $chaussures = Chaussure::all();


        //ici une foreach pour afficher l'image de chaque chaussure qui est dans la liste à la vue
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

        //pour afficher la page de création de chaussure avec listtypechaussures pour attribuer la type à la chaussure
        $list_type_chaussures = listTypeChaussures::all();

            return view('admin.modification', [
                'chaussures' => $chaussures,
                'list_type_chaussures' => $list_type_chaussures,
            ]);

    }

    public function modifier(Request $request)
    {
        //ici c'est pour afficher une chaussure un particulier si on clique sur sa carte
        $id = $request->id;

        $chaussure = Chaussure::findOrFail($id);

        //ici  pour afficher l'image de chaque chaussure qui est dans la liste à la vue
            $images = ImageChaussure::where('id_chaussure', $id)->get();
            $chaussure->image = $images->first();

            $rabais = null;
            $pourcentage = null;
            if ($rabais) {
            $rabais = Rabais::where('id_chaussure', $id)->where('expiration_rabais', '>', now())->first();
            $pourcentage = $rabais->rabais;
            }

        if (view()->exists('chaussures.chaussure.modifier')) {
            return view('chaussures.chaussure.modifier', [
                'chaussure' => $chaussure,
                'pourcentage' => $pourcentage,
            ]);
        } else {
            abort(404);
        }
    }

    public function modifierChaussure(Request $request)
    {

        $id = $request->id;
        //on apporte les modifications dans la base de donné
        $chaussure = Chaussure::find($id);

        $chaussure->modele = $request->input('modele');
        $chaussure->marque = $request->input('marque');
        $chaussure->prix = $request->input('prix');
        $chaussure->couleurP = $request->input('couleurP');
        $chaussure->couleurS = $request->input('couleurS');
        $chaussure->genre = $request->input('genre');

        $chaussure->save();




        //afficher l'image de chaque chaussure qui est dans la liste à la vue
        $images = ImageChaussure::where('id_chaussure', $id)->get();
        $chaussure->image = $images->first();

         // Récupérer les avis pour cette chaussure
         $avis = Avis::with('user')->where('id_chaussure', $id)->get();

         // Calculer la moyenne des étoiles et le total des commentaires  pour cette chaussure
         $totalEtoiles = 0;
         $totalAvis = $avis->count();
         foreach ($avis as $avisItem) {
             $totalEtoiles += $avisItem->etoile;
         }
         $moyenneEtoiles = $totalEtoiles / ($totalAvis ?: 1);

          // Récupérer le rabais pour cette chaussure s'il y en a un et en fonction de la date
        $rabais = Rabais::where('id_chaussure', $id)->where('expiration_rabais', '>', now())->first();

        // Mettre à jour le rabais avec les données de la requête s'il existe déjà
        Rabais::where('id_chaussure', $id)->update([
            'rabais' => $request->input('rabais'),
            'expiration_rabais' => $request->input('date'),
        ]);

            // Créer un nouveau rabais avec les données de la requête s'il n'existe pas déjà
            if (!$rabais) {
                $nouveauRabais = new Rabais();
                $nouveauRabais->id_chaussure = $id;
                $nouveauRabais->rabais = $request->input('rabais');
                $nouveauRabais->expiration_rabais = $request->input('date');
                $nouveauRabais->save();
            }

        // Calculer le prix en prenant en compte le rabais s'il y en a un
        $pourcentage = null;
        $prix = $chaussure->prix;
        if ($rabais) {
            $pourcentage = $rabais->rabais;
            $prixReduit = $prix - ($prix * $rabais->rabais / 100);
            $prix = $prixReduit;
        }


        return redirect()->route('chaussures.show', ['id' => $chaussure->id_chaussure]);
    }
    // Suppression d'une chassure
    public function destroy($id)
    {
        $chaussure = Chaussure::find($id);
        $chaussure->delete();
        //retour sur la page pour gérer les chaussures
        return redirect()->route('modification');
    }

}
