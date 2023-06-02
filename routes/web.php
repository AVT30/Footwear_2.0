<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ChaussuresController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\WhislistController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\AdresseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\GererUserController;
use App\Http\Controllers\GererAvisController;
use App\Http\Controllers\CommandeController;
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

Route::get('/', [Controller::class, 'index'])->name('accueil');

// Routes d'authentification de Laravel Breeze
require __DIR__ . '/auth.php';

//route pour la page d'accueil
Route::get('/accueil', [Controller::class, 'index'])->name('accueil');

//la search bar
Route::get('/search', [SearchController::class, 'search'])->name('search');


// Page pour une chaussure en particulier en cliquant dessus
Route::get('/chaussures/{id}', [ChaussuresController::class, 'show'])->name('chaussures.show');


// Page pour une chaussure en particulier en cliquant dessus
Route::get('/afficheRabais', [ChaussuresController::class, 'afficheRabais'])->name('affiche-rabais');

// Modifier une chaussure en particulier en cliquant dessus
Route::put('/chaussures/{id}/modifierChaussure', [ChaussuresController::class, 'modifierChaussure'])->name('chaussures.modifierChaussure');

// supprimer une chaussure en particulier en cliquant dessus
Route::delete('/chaussures/{id}/supprimer', [ChaussuresController::class, 'destroy'])->name('chaussures.supprimer');

//code  pour  une page est accessible seulement connecté
Route::get('/whislist', [WhislistController::class, 'whislist'])->middleware(['auth', 'verified'])->name('whislist');


//page panier
Route::get('/panier', [PanierController::class, 'panier'])->name('panier');

//page panier
Route::post('/panier/add/{id}', [PanierController::class, 'add'])->name('panier_add');

//page panier pour supprimer les articles du panier
Route::get('/panier/supprimer/{id}', [PanierController::class, 'supprimerArticle'])->name('supprimerArticle');

//page checkout
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

//page avis
Route::get('/avisuser/{id}', [AvisController::class, 'avisuser'])->name('avisuser');

//page utilisateurs
Route::get('/utilisateurs', [PanierController::class, 'panier'])->name('panier');

//page adresse
Route::get('/adresse', [AdresseController::class, 'adresse'])->middleware(['auth', 'verified'])->name('adresse');

//page creation adresse
Route::post('/creationadresse', [AdresseController::class, 'creationadresse'])->middleware(['auth', 'verified'])->name('creationadresse');

//route pour supprimer l'adresse
Route::delete('/adresses/{id}', [AdresseController::class, 'destroy'])->name('adresses.destroy');

//pour le payememt
Route::get('/stripe', [StripeController::class, 'stripe'])->name("stripe");
Route::post('/stripe', [StripeController::class, 'stripePost'])->name('stripePost');


//pour la page commandes
Route::get('/commandes', [CommandeController::class, 'commandes'])->middleware(['auth', 'verified'])->name("commandes");


//ça renvoie a la fonction ajoutwishlist pour ajouter l'article
Route::get('/whislist/{id}/ajoutwhislist', [WhislistController::class, 'ajoutwhislist'])->middleware(['auth', 'verified'])->name('whislist.ajoutwhislist');

//meme chose que la fonction ajoutwishlist pour ajouter l'article mais pour retirer l'article
Route::get('/whislist/{id}', [WhislistController::class, 'supprimerwhislist'])->middleware(['auth', 'verified'])->name('whislist.supprimerwhislist');

//les routes pour le captcha
Route::get('/contact-form', [RegisteredUserController::class, 'index']);
Route::post('/captcha-validation', [RegisteredUserController::class, 'capthcaFormValidate']);
Route::get('/reload-captcha', [RegisteredUserController::class, 'reloadCaptcha']);



//pour le pdf de la commande (je prends le numero de commande car comme ca je prends toutes les chaussures qui concernent la commande)
Route::get('/commande/pdf/{numeroCommande}', [CommandeController::class, 'genererPDF'])->name('commande.pdf');


// Les routes réservées aux administrateurs
Route::group(['middleware' => ['auth', 'admin']], function () {


    //page pour la page création de chaussre et pour faciliter l'entrée de donnée pour l'admin
    Route::post('/creation', [ChaussuresController::class, 'creation'])->name('chaussures.creation');

    //page pour la création de chaussre
    Route::get('/creation', [ChaussuresController::class, 'creationchaussure'])->name('chaussures.creationchaussure');

    //page pour modification
    Route::get('/modification', [ChaussuresController::class, 'modification'])->name('modification');


    //page pour une chaussure en particulier en cliquant dessuss
    Route::get('/chaussures/{id}/modifier', [ChaussuresController::class, 'modifier'])->name('chaussures.modifier');

    //gérér utilisateurs
    Route::get('/gereruser', [GererUserController::class, 'utilisateurs'])->name('gereruser');

    //gérér avis
    Route::get('/gereravis', [GererAvisController::class, 'avis'])->name('gereravis');

    //gerer l'activation et désactivation des comptes users
    Route::put('/gerer-users/activer/{id}', [GererUserController::class, 'activer'])->name('gerer-users.activer');
    Route::put('/gerer-users/desactiver/{id}', [GererUserController::class, 'desactiver'])->name('gerer-users.desactiver');

    //gerer l'activation et désactivation des avis
    Route::post('avis/{id}/accepter', [GererAvisController::class, 'accepterAvis'])->name('avis.accepter');
    Route::delete('avis/{id}/supprimer', [GererAvisController::class, 'supprimerAvis'])->name('avis.supprimer');



});

//pour acceder a ces chemins l'utilisateur doit être connecté
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route dynamique pour afficher des chaussures en fonction de leur type en cliquant sur le mega menu
Route::get('/{types}', [ChaussuresController::class, 'chaussures'])->name('chaussures.list');
