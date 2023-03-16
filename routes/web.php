<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ChaussuresController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//pour les pages d'inscription et de connexion
require __DIR__.'/auth.php';

//route pour la page d'accueil
Route::get('/accueil', [Controller::class, 'index'])->name('accueil');


//page pour la page création de chaussre et pour faciliter l'entrée de donnée pour l'admin
Route::post('/creation', [ChaussuresController::class, 'creation'])->name('chaussures.creation');

//page pour la création de chaussre
Route::get('/creation', [ChaussuresController::class, 'creationchaussure'])->name('chaussures.creationchaussure');

//a voir. pour la search bar
Route::get('/search', [SearchController::class, 'search'])->name('search');



//page pour une chaussure en particulier en cliquant dessuss
Route::get('/chaussures/{id}', [ChaussuresController::class, 'show'])->name('chaussures.show');




//code en commentaire comme exemple pour si une page est accessible seulement connecté
// Route::get('/accueil', function () {
//     return view('accueil');
// })->middleware(['auth', 'verified'])->name('accueil');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route dynamique pour afficher des chaussures en fonction de leur type en cliquant sur le mega menu
Route::get('/{types}', [ChaussuresController::class, 'chaussures'])->name('chaussures.list');

