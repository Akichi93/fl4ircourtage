<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\BrancheController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\ApporteurController;
use App\Http\Controllers\CompagnieController;
use App\Http\Controllers\ProspectsController;

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
    Route::controller(CompagnieController::class)->group(function () {
        Route::get('/compagnieList/{q?}',  'compagnieList'); // la liste des compagnies
        Route::post('postCompagnie',  'postCompagnie'); // Ajouter une compagnie
        Route::get('editCompagnie/{id_compagnie}',  'editCompagnie'); // Recuperer les infos de la compagnie
        Route::patch('deleteCompagnie/{id_compagnie}',  'deleteCompagnie'); // Supprimer une compagnie
        Route::patch('updateCompagnie/{id_compagnie}',  'updateCompagnie'); // Update d'une compagnie
        Route::get('getTauxCompagnie/{id_compagnie}',  'getTauxCompagnie'); // Obtenir les taux d'une compagnie
        Route::get('getNameCompagnie/{id_compagnie}',  'getNameCompagnie'); // Obtenir le nom de la compagnie choisi
        Route::get('editTauxCompagnie/{id_tauxcomp}',  'editTauxCompagnie'); //Recuperer les infos d'un taux
        Route::get('getBrancheDiffCompagnie/{id_compagnie}',  'getBrancheDiffCompagnie'); // Obtenir branche
        Route::post('postTauxCompagnie',  'postTauxCompagnie');
        Route::post('updateTauxCompagnie',  'updateTauxCompagnie');
        Route::get('getCompagnie',  'getCompagnie'); // Obtenir les compagnies
    });


    // Prospects
    Route::controller(ProspectsController::class)->group(function () {
        Route::get('prospectList/{q?}',  'prospectList');
        Route::post('postProspect',  'postProspect'); // Ajouter un contrat
        Route::get('editProspect/{id_prospect}',  'editProspect');
        Route::post('validateProspect',  'validateProspect');
        Route::patch('deleteProspect/{id_prospect}',  'deleteProspect');
        Route::patch('etatProspect/{id_prospect}',  'etatProspect');
        Route::patch('updateProspect/{id_prospect}',  'updateProspect'); // Update d'une compagnie
        Route::get('getBrancheDiffProspect',  'getBrancheDiffProspect'); // Obtenir branche
        Route::post('postBrancheProspect',  'postBrancheProspect');
        Route::get('getNameProspect',  'getNameProspect'); // Obtenir le nom de l'apporteur choisi
        Route::get('getBrancheProspect',  'getBrancheProspect');
    });


    // Route::get('prospectList/{q?}', [ProspectController::class, 'prospectList']);
    // Route::post('postProspect', [ProspectController::class, 'postProspect']); // Ajouter un contrat
    // Route::get('editProspect/{id_prospect}', [ProspectController::class, 'editProspect']);
    // Route::post('validateProspect', [ProspectController::class, 'validateProspect']);
    // Route::patch('deleteProspect/{id_prospect}', [ProspectController::class, 'deleteProspect']);
    // Route::patch('etatProspect/{id_prospect}', [ProspectController::class, 'etatProspect']);
    // Route::patch('updateProspect/{id_prospect}', [ProspectController::class, 'updateProspect']); // Update d'une compagnie
    // Route::get('getBrancheDiffProspect', [ProspectController::class, 'getBrancheDiffProspect']); // Obtenir branche
    // Route::post('postBrancheProspect', [ProspectController::class, 'postBrancheProspect']);
    // Route::get('getNameProspect', [ProspectController::class, 'getNameProspect']); // Obtenir le nom de l'apporteur choisi
    // Route::get('getBrancheProspect', [ProspectController::class, 'getBrancheProspect']);

    //  // Client
    //  Route::get('/clientList/{q?}', [ClientController::class, 'clientList']);
    //  Route::post('postClient', [ClientController::class, 'postClient']); // Ajouter un apporteur
    //  Route::get('editClient/{id_client}', [ClientController::class, 'editClient']);
    //  Route::patch('updateClient/{id_client}', [ClientController::class, 'updateClient']);
    //  Route::get('getClient', [ClientController::class, 'getClient']);
    //  Route::get('editRelance/{id_relance}', [ClientController::class, 'editRelance']);
    //  Route::get('getRelance', [ClientController::class, 'getRelance']);
    //  Route::get('getOneExpiration', [ClientController::class, 'getOneExpiration']);
    //  Route::get('getTwoExpiration', [ClientController::class, 'getTwoExpiration']);


});
