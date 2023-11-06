<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\BrancheController;
use App\Http\Controllers\ApporteurController;
use App\Http\Controllers\CompagnieController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/user/profile', [AuthController::class, 'userProfile']);

    // Branche
    Route::controller(BrancheController::class)->group(function () {
        Route::get('/branchesList/{q?}', 'branchesList'); // Listes des branches avec pagignation et recherche
        Route::get('editBranche/{id_branche}', 'editBranche');
        Route::patch('deleteBranche/{id_branche}', 'deleteBranche'); // Suppression d'une branche 
        Route::patch('updateBranche/{id_branche}', 'updateBranche'); // Update d'une branche
    });

    //Form
    Route::controller(FormController::class)->group(function () {
        //Form get
        Route::get('getLocalisations', 'getLocalisations');
        Route::get('getProfessions', 'getProfessions');
        Route::get('getMarques', 'getMarques');
        Route::get('getEnergies', 'getEnergies');
        Route::get('getCouleurs', 'getCouleurs');
        Route::get('getGenres', 'getGenres');
        Route::get('getCategories', 'getCategories');
        Route::get('getBranches', 'getBranches');
        Route::get('getSecteurs', 'getSecteurs');
        Route::get('getRoles', 'getRoles');

        // Form post
        Route::post('postLocalisations', 'postLocalisations');
        Route::post('postProfessions', 'postProfessions');
        Route::post('postMarques', 'postMarques');
        Route::post('postEnergies', 'postEnergies');
        Route::post('postCouleurs', 'postCouleurs');
        Route::post('postGenres', 'postGenres');
        Route::post('postCategories', 'postCategories');
        Route::post('postBranches', 'postBranches');
        Route::post('postSecteurs', 'postSecteurs');
        Route::post('createentreprise', 'createentreprise')->name('createentreprise');
    });

    // Apporteur
    Route::controller(ApporteurController::class)->group(function () {
        Route::get('/apporteurList/{q?}', 'apporteursList'); // La liste des apporteurs
        Route::post('postApporteur', 'postApporteur'); // Ajouter un apporteur
        Route::get('editApporteur/{id_apporteur}', 'editApporteur'); // Recuperer les infos d'un apporteur
        Route::patch('deleteApporteur/{id_apporteur}', 'deleteApporteur'); // Supprimer un apporteur
        Route::patch('updateApporteur/{id_apporteur}', 'updateApporteur'); // Update d'un apporteur
        Route::get('getTauxApporteur/{id_apporteur}', 'getTauxApporteur'); // Obtenir les taux d'un apporteur
        Route::get('getNameApporteur/{id_apporteur}', 'getNameApporteur'); // Obtenir le nom de l'apporteur choisi
        Route::get('editTauxApporteur/{id_tauxapp}', 'editTauxApporteur'); //Recuperer les infos d'un taux
        Route::get('getBrancheDiffApporteur/{id_tauxapp}', 'getBrancheDiffApporteur'); // Obtenir branche
        Route::post('postTauxApporteur', 'postTauxApporteur');
        Route::post('updateTauxApporteur', 'updateTauxApporteur');
        Route::get('getApporteur', 'getApporteur'); // Obtenir les compagnies
    });

    // Compagnies

     // Apporteur
     Route::controller(CompagnieController::class)->group(function () {
        Route::get('/compagnieList/{q?}',  'compagnieList'); // la liste des compagnies
        Route::post('postCompagnie',  'postCompagnie'); // Ajouter une compagnie
        Route::get('editCompagnie/{id_apporteur}',  'editCompagnie'); // Recuperer les infos de la compagnie
        Route::patch('deleteCompagnie/{id_apporteur}',  'deleteCompagnie'); // Supprimer une compagnie
        Route::patch('updateCompagnie/{id_compagnie}',  'updateCompagnie'); // Update d'une compagnie
        Route::get('getTauxCompagnie',  'getTauxCompagnie'); // Obtenir les taux d'une compagnie
        Route::get('getNameCompagnie',  'getNameCompagnie'); // Obtenir le nom de la compagnie choisi
        Route::get('editTauxCompagnie/{id_tauxapp}',  'editTauxCompagnie'); //Recuperer les infos d'un taux
        Route::get('getBrancheDiffCompagnie',  'getBrancheDiffCompagnie'); // Obtenir branche
        Route::post('postTauxCompagnie',  'postTauxCompagnie');
        Route::post('updateTauxCompagnie',  'updateTauxCompagnie');
        Route::get('getCompagnie',  'getCompagnie'); // Obtenir les compagnies

     });
    
});
