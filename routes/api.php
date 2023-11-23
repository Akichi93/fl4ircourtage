<?php

use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\BrancheController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\SinistreController;
use App\Http\Controllers\ApporteurController;
use App\Http\Controllers\CompagnieController;
use App\Http\Controllers\ProspectsController;
use App\Http\Controllers\EntrepriseController;


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


Route::post('post-registration', [EntrepriseController::class, 'postRegistration'])->name('register.post');
Route::post('post-reset', [EntrepriseController::class, 'postReset'])->name('reset.post');

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
        Route::get('getBrancheDiffProspect/{id_prospect}',  'getBrancheDiffProspect'); // Obtenir branche
        Route::post('postBrancheProspect',  'postBrancheProspect');
        Route::get('getNameProspect',  'getNameProspect'); // Obtenir le nom de l'apporteur choisi
        Route::get('getBrancheProspect',  'getBrancheProspect');
    });


    // Clients
    Route::controller(ClientController::class)->group(function () {
        Route::get('/clientList/{q?}', 'clientList');
        Route::post('postClient', 'postClient'); // Ajouter un apporteur
        Route::get('editClient/{id_client}', 'editClient');
        Route::patch('updateClient/{id_client}', 'updateClient');
        Route::get('getClient', 'getClient');
        Route::get('editRelance/{id_relance}', 'editRelance');
        Route::get('getRelance', 'getRelance');
        Route::get('getOneExpiration', 'getOneExpiration');
        Route::get('getTwoExpiration', 'getTwoExpiration');
    });

    // // Contrats
    // // Route::get('file/avenants/{id_avenant}', [ContratController::class, 'fileAvenant']);
    // // Route::post('contrats/auto', [ContratController::class, 'auto']);
    // // Route::get('get/automobiles', [ContratController::class, 'infoAutos']);
    // // Route::post('edit/automobile', [ContratController::class, 'editAutomobile']);
    // // Route::get('get/autos', [ContratController::class, 'getAutos']);



    // Contrat
    Route::controller(ContratController::class)->group(function () {
        Route::get('/contratList/{q?}', 'contratList');
        Route::get('editContrat/{id_contrat}', 'editContrat');
        Route::post('postContrat', 'postContrat'); // Ajouter un contrat
        Route::patch('deleteContrat/{id_contrat}', 'deleteContrat');
        Route::post('soldeContrat', 'soldeContrat');
        Route::post('soldeAvenant', 'soldeAvenant');
        Route::post('reverseContrat', 'reverseContrat');
        Route::post('reverseAvenant', 'reverseAvenant');
        Route::get('getAvenantContrat/{id_contrat}', 'getAvenantContrat'); // Obtenir les avenants d'un contrat
        Route::get('getInfoAvenant', 'getInfoAvenant');
        Route::get('editAvenant/{id_avenant}', 'editAvenant');
        Route::post('deleteAvenant', 'deleteAvenant');
        Route::post('postAvenant', 'postAvenant'); // Ajouter un avenant
        Route::post('postFileAvenant', 'postFileAvenant');
        Route::get('getFileAvenant/{id_avenant}', 'getFileAvenant');
        Route::get('getInfoAvenantContrat', 'getInfoAvenantContrat');
        Route::get('getInfoContrat', 'getInfoContrat');
        Route::get('getCountsinistre', 'getCountsinistre');
        Route::get('getInfosinistres', 'getInfosinistres');
        Route::get('getInfoFileContrat', 'getInfoFileContrat');
        Route::get('getInfoFileSinistre', 'getInfoFileSinistre');
        Route::get('getInfoVehicules', 'getInfoVehicules');
        Route::post('postAutomobile', 'postAutomobile');
        Route::post('postGarantie', 'postGarantie');
        Route::get('getFileViewAvenant/{id_avenant}', 'getFileViewAvenant');
        Route::get('getTauxBrancheCompagnie', 'getTauxBrancheCompagnie');
        Route::get('getTauxBrancheApporteur', 'getTauxBrancheApporteur');
        Route::get('getViewContrat', 'getViewContrat');
        Route::patch('updateContrat/{id_contrat}', 'updateContrat'); // Update d'une compagnie
        Route::get('getFactures/{id_avenant}', 'getFactures');
    });

    // Sinistres
    Route::controller(SinistreController::class)->group(function () {
        Route::get('get-polices', 'getPolices');
        Route::get('get/police/{id}', 'getPolice');
        Route::post('add/sinistre', 'addSinistre');
        Route::put('update/sinistre/{id}', 'updateSinistre');
        Route::get('get/sinistres/{q?}', 'getSinistres');
        Route::get('get/sinistre', 'getSinistre');
        Route::get('get/apporteur', 'getApporteur');
        Route::get('get/reglements', 'getReglements');
        Route::get('get/reglement', 'getReglement');
        Route::post('add/piece', 'addPiece');
        Route::put('update-sinistre-status/{id}', 'updateSinistreStatus');
        Route::post('add/reglement', 'addReglement');
        Route::put('change/reglement/{id}', 'changeReglement');
        Route::patch('sinistres/supprime/{id_sinistre}', 'supprime');
        Route::get('sinistres/edit/{id_sinistre}', 'edit');
    });

    // Dashboard
    Route::get('/graph', [HomeController::class, 'graph'])->name('graph');
    Route::get('/stat', [HomeController::class, 'stat'])->name('stat');
    Route::get('/year', [HomeController::class, 'year'])->name('year');
    Route::get('/retrievebranche', [HomeController::class, 'retrievebranche']);



    // Entreprise
    Route::resource('entreprises', EntrepriseController::class);
    Route::get('entreprises/edit/{id_entreprise}', [EntrepriseController::class, 'edit']);




    // Statistiques

    Route::get('/modulestat', [StatController::class, 'modulestat'])->name('modulestat');
    Route::get('/synthese', [StatController::class, 'synthese'])->name('synthese');
    Route::get('detailsclient/{id_client}', [StatController::class, 'detailsclient'])->name('detailsclient');
    Route::get('detailscontrats/{id_contrat}', [StatController::class, 'detailscontrats'])->name('detailscontrats');
    Route::get('infosinistre/{id_contrat}', [StatController::class, 'infosinistre'])->name('infosinistre');
    Route::get('/sinis', [StatController::class, 'sinis'])->name('sinis');
    Route::get('/productions', [StatController::class, 'productions'])->name('productions');
    Route::get('/statapporteur', [StatController::class, 'statapporteur'])->name('statapporteur');
    Route::get('/statsupprime', [StatController::class, 'statsupprime'])->name('statsupprime');
    Route::get('detailsapporteurs/{id_apporteur}', [StatController::class, 'detailsapporteurs'])->name('detailsapporteurs');

    Route::get('/expiredata/{search?}', [StatController::class, 'expiredata']);

    // //  Roles
    Route::resource('roles', RoleController::class);



    // // Users
    Route::resource('utilisateurs', UsersController::class);
    Route::get('utilisateurs/edit/{id}', [UsersController::class, 'edit']);
    Route::get('get/logs', [UsersController::class, 'getLogs']);
    Route::get('getrole', [UsersController::class, 'getRole']);

    // Route::get('get/expires', [HomeController::class, 'getexpires'])->name('contrats/getexpires');
    // Route::get('get/nonsoldes', [HomeController::class, 'getnonsoldes']);
    // Route::get('get/soldes', [HomeController::class, 'getsoldes']);
    // Route::get('get/nonreverses', [HomeController::class, 'getnonreverses']);
    // Route::post('searchexpires', [HomeController::class, 'searchexpires']);
    // Route::post('searchnonsolde', [HomeController::class, 'searchnonsolde']);
    // Route::post('searchsolde', [HomeController::class, 'searchsolde']);
    // Route::post('searchnonreverses', [HomeController::class, 'searchnonreverses']);


      // Import de fichier
      Route::controller(UploadController::class)->group(function () { 
        Route::post('importclient', 'importclient');
        Route::post('importprospect', 'importprospect');
        Route::post('importapporteur', 'importapporteur');
        Route::post('importauxapporteur', 'importauxapporteur');
        Route::post('importcompagnie', 'importcompagnie');
        Route::post('importauxcompagnie', 'importauxcompagnie');
        Route::post('importcontrat', 'importcontrat');
        Route::post('importsinistre', 'importsinistre');
        Route::post('importautomobile', 'importautomobile');
      });
});
