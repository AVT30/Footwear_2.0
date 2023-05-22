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
use App\Models\User;
use Illuminate\View\View;

class GererUserController extends Controller
{
    //afficher tous les utilisatuers dans le tableau
    public function utilisateurs()
    {
        $users = User::all();

        $usersPerPage = 5; // Nombre d'utilisateurs par page

        $users = User::paginate($usersPerPage); //pour l'affichage limité d'utilisateur de 5 par tableau


        return view('gereruser', [
            'users' => $users,
        ]);
    }

    //Activer les utilisateurs qui sont désactivé
    public function activer($id)
    {
        $user = User::findOrFail($id);
        $user->isActive = true;
        $user->save();

        return redirect()->back();
    }

    //Dàsactiver les utilisateurs qui sont activé
    public function desactiver($id)
    {
        $user = User::findOrFail($id);
        $user->isActive = false;
        $user->save();

        return redirect()->back();
    }
}
