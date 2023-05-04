<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ChaussuresController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\WhislistController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\RegisteredUserController;
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

Route::get('/modification', [ChaussuresController::class, 'modification'])->name('modification');

//la search bar
Route::get('/search', [SearchController::class, 'search'])->name('search');

//page pour une chaussure en particulier en cliquant dessuss
Route::get('/chaussures/{id}/modifier', [ChaussuresController::class, 'modifier'])->name('chaussures.modifier');

//page pour une chaussure en particulier en cliquant dessuss
Route::put('/chaussures/{id}/modifierChaussure', [ChaussuresController::class, 'modifierChaussure'])->name('chaussures.modifierChaussure');

//page pour une chaussure en particulier en cliquant dessuss
Route::get('/chaussures/{id}', [ChaussuresController::class, 'show'])->name('chaussures.show');


//code  pour  une page est accessible seulement connecté
Route::get('/whislist', [WhislistController::class, 'whislist'])->middleware(['auth', 'verified'])->name('whislist');


//page panier
Route::get('/panier', [PanierController::class, 'panier'])->name('panier');

//page panier
Route::post('/panier/add/{id}', [PanierController::class, 'add'])->name('panier_add');

//page panier pour supprimer les articles du panier
Route::get('/panier/supprimer/{id}',[PanierController::class, 'supprimerArticle'])->name('supprimerArticle');

//page checkout
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

//page avis
Route::post('/avis', [AvisController::class, 'avis'])->name('avis');



//ça renvoie a la fonction ajoutwishlist pour ajouter l'article
Route::get('/whislist/{id}/ajoutwhislist', [WhislistController::class, 'ajoutwhislist'])->middleware(['auth', 'verified'])->name('whislist.ajoutwhislist');

//meme chose que la fonction ajoutwishlist pour ajouter l'article mais pour retirer l'article
Route::get('/whislist/{id}', [WhislistController::class, 'supprimerwhislist'])->middleware(['auth', 'verified'])->name('whislist.supprimerwhislist');

//les routes pour le captcha
Route::get('/contact-form', [RegisteredUserController::class, 'index']);
Route::post('/captcha-validation', [RegisteredUserController::class, 'capthcaFormValidate']);
Route::get('/reload-captcha', [RegisteredUserController::class, 'reloadCaptcha']);




//pour acceder a ces chemins l'utilisateur doit être connecté
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route dynamique pour afficher des chaussures en fonction de leur type en cliquant sur le mega menu
Route::get('/{types}', [ChaussuresController::class, 'chaussures'])->name('chaussures.list');

