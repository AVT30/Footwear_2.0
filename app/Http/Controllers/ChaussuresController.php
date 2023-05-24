<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Chaussure;
use App\Models\listTypeChaussures;
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
        // Récupère toutes les chasussures
        $chaussures = Chaussure::all();

        // Récupère toutes les types de chaussures
        $listTypeChaussures = listTypeChaussures::all();

        // Mélange les chaussures afin d'afficher une liste de chaussures au hasard
        $type_slug = strtolower(str_replace(" ", "-", $type));

        // Pour chaque type de chaussure, récupère les chaussures paginées avec leurs rabais correspondants
        $chaussuresPagineesParType = [];
        foreach ($listTypeChaussures as $typeChaussure) {
            $chaussuresType = Chaussure::where('id_list_types', $typeChaussure->id_list_types)->paginate(9);

            // Pour chaque chaussure, récupère le rabais correspondant
            foreach ($chaussuresType as $chaussure) {
                $images = ImageChaussure::where('id_chaussure', $chaussure->id_chaussure)->get();
                $chaussure->image = $images->first();

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

            // Ajouter les chaussures paginées par type à l'array
            $chaussuresPagineesParType[$typeChaussure->type_chaussures] = $chaussuresType;
        }

        if (view()->exists('chaussures.' . $type_slug)) {
            return view('chaussures.' . $type_slug, [
                'chaussures' => $chaussures,
                'chaussuresPagineesParType' => $chaussuresPagineesParType,
                'listTypeChaussures' => $listTypeChaussures,
            ]);
        } else {
            abort(404);
        }
    }


    //affichage flux chaussures dans l'acceuil
    public function accueil()
    {
        $chaussures = Chaussure::orderBy('created_at', 'desc')->take(10)->get();
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
            'prix' => $prix,
            // passer le prix calculé à la vue et s'il n'y a pas de rabais ca affiche le prix de base
            'pourcentage' => $pourcentage,
            'moyenneEtoiles' => $moyenneEtoiles,
            'totalAvis' => $totalAvis
        ]);
    }


    public function creationchaussure(Request $request)
    {
        //pour afficher la page de création de chaussure avec listtypechaussures pour attribuer la type à la chaussure
        $listTypeChaussures = listTypeChaussures::all();

        return view('admin.creation', [
            'listTypeChaussures' => $listTypeChaussures
        ]);
    }

    public function creation(Request $request)
    {
        //création de la chaussure pour l'admin pour faciliter l'ajout

        $chaussure = Chaussure::create([
            'modele' => $request->input('modele'),
            'marque' => $request->input('marque'),
            'genre' => $request->input('genre'),
            'id_list_types' => $request->input('type-chaussures'),
            'couleurP' => $request->input('couleurP'),
            'couleurS' => $request->input('couleurS'),
            'prix' => $request->input('prix'),
        ]);

        //on mets un validate pour que le rabais et la date d expiration soient toutes les deux remplis
        $request->validate([
            'rabais' => 'required_with:daterabaisexpiration',
            'daterabaisexpiration' => 'required_with:rabais',
        ]);

        $idChaussure = $chaussure->id_chaussure;

        // Vérifier si une image a déjà été téléchargée pour cette chaussure
        $imageExists = ImageChaussure::where('id_chaussure', $idChaussure)->exists();
        if ($imageExists) {
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

        // Si le rabais n'est pas vide et est un nombre entre 5 et 75 inclus
        if (!empty($pourcentageRabais) && $pourcentageRabais >= 5 && $pourcentageRabais <= 75) {
            // On crée une nouvelle réduction pour la chaussure
            $rabais = new Rabais();
            $rabais->id_chaussure = $idChaussure;
            $rabais->rabais = $pourcentageRabais;
            $rabais->expiration_rabais = $request->daterabaisexpiration; // Date d'expiration du rabais
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
        $listTypeChaussures = listTypeChaussures::all();

        return view('admin.modification', [
            'chaussures' => $chaussures,
            'listTypeChaussures' => $listTypeChaussures,
        ]);
    }

    public function modifier(Request $request)
    {
        //ici c'est pour afficher une chaussure un particulier si on clique sur sa carte
        $id = $request->id;

        $chaussure = Chaussure::findOrFail($id);
        $listTypeChaussures = listTypeChaussures::all();

        //ici  pour afficher l'image de chaque chaussure qui est dans la liste à la vue
        $images = ImageChaussure::where('id_chaussure', $id)->get();
        $chaussure->image = $images->first();

        $rabais = Rabais::where('id_chaussure', $chaussure->id_chaussure)->where('expiration_rabais', '>', now())->first();

        $pourcentage = null;
        $prix = $chaussure->prix;

        if ($rabais) {
            $pourcentage = $rabais->rabais;
            $prixReduit = $prix - ($prix * $rabais->rabais / 100);
            $prix = $prixReduit;
        }

        if (view()->exists('chaussures.chaussure.modifier')) {
            return view('chaussures.chaussure.modifier', [
                'chaussure' => $chaussure,
                'listTypeChaussures' => $listTypeChaussures,
                'rabais' => $rabais,
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
        $chaussure->id_list_types = $request->input('type-chaussures');

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

        if (!$request->filled('rabais') && !$request->filled('daterabaisexpiration')) {
            // Les deux champs sont vides, donc pas de rabais à appliquer
        } else {
            // Au moins un des champs est rempli, donc on procède avec la création ou la mise à jour du rabais

            if ($rabais) {
                $request->validate([
                    'rabais' => 'required_with:daterabaisexpiration',
                    'daterabaisexpiration' => 'required_with:rabais',
                ]);

                // Mettre à jour le rabais avec les données de la requête s'il existe déjà
                $rabais->rabais = $request->input('rabais');
                $rabais->expiration_rabais = $request->input('daterabaisexpiration');
                $rabais->save();
            } else {
                $request->validate([
                    'rabais' => 'required_with:daterabaisexpiration',
                    'daterabaisexpiration' => 'required_with:rabais',
                ]);

                // Créer un nouveau rabais avec les données de la requête s'il n'existe pas déjà
                $nouveauRabais = new Rabais();
                $nouveauRabais->id_chaussure = $id;
                $nouveauRabais->rabais = $request->input('rabais');
                $nouveauRabais->expiration_rabais = $request->input('daterabaisexpiration');
                $nouveauRabais->save();
            }

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
