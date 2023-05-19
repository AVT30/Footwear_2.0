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
    public function utilisateurs()
    {
        $users = User::all();

        return view('gereruser', [
            'users' => $users,
        ]);
    }
}
