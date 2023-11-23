<?php

namespace App\Http\Controllers;

use App\Models\Branche;
use Illuminate\Http\Request;
use App\Repositories\FormRepository;
use App\Http\Requests\BrancheRequest;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;


class FormController extends Controller
{
    protected $localisation;
    protected $profession;
    protected $marque;
    protected $energie;
    protected $couleur;
    protected $categorie;
    protected $genre;
    protected $branche;
    protected $secteur;
    protected $role;
    protected $log;

    public function __construct(
        FormRepository $localisation,
        FormRepository $profession,
        FormRepository $marque,
        FormRepository $energie,
        FormRepository $couleur,
        FormRepository $categorie,
        FormRepository $genre,
        FormRepository $branche,
        FormRepository $secteur,
        FormRepository $role,
        FormRepository $log
    ) {
        $this->localisation = $localisation;
        $this->profession = $profession;
        $this->marque = $marque;
        $this->energie = $energie;
        $this->couleur = $couleur;
        $this->categorie = $categorie;
        $this->genre = $genre;
        $this->branche = $branche;
        $this->secteur = $secteur;
        $this->role = $role;
        $this->log = $log;
    }

    /*
      |----------------------------------------------------
      | Liste des villes et quartiers
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des villes et quartiers.
      |
     */

    public function getLocalisations()
    {
        $localisations = $this->localisation->getLocalisations();

        return response()->json($localisations);
    }

    /*
      |----------------------------------------------------
      | Liste des professions
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des professions.
      |
     */

    public function getProfessions()
    {
        $professions = $this->profession->getProfessions();

        return response()->json($professions);
    }

    /*
      |----------------------------------------------------
      | Liste des marques
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des marques.
      |
     */

    public function getMarques()
    {
        $marques = $this->marque->getMarques();

        return response()->json($marques);
    }

    /*
      |----------------------------------------------------
      | Liste des energies
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des energies.
      |
     */

    public function getEnergies()
    {

        $energies = $this->energie->getEnergies();

        return response()->json($energies);
    }

    /*
      |----------------------------------------------------
      | Liste des couleurs
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des couleurs.
      |
     */

    public function getCouleurs()
    {
        $couleurs = $this->couleur->getCouleurs();

        return response()->json($couleurs);
    }

    /*
      |----------------------------------------------------
      | Liste des catégories
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des catégories.
      |
     */

    public function getCategories()
    {
        $categories = $this->categorie->getCategories();

        return response()->json($categories);
    }

    /*
      |----------------------------------------------------
      | Liste des genres
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des genres.
      |
     */

    public function getGenres()
    {
        $genres = $this->genre->getGenres();

        return response()->json($genres);
    }

    /*
      |----------------------------------------------------
      | Liste des branches
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des branches.
      |
     */

    public function getBranches()
    {
        $user = JWTAuth::parseToken()->authenticate();

        $entreprise = $user->id_entreprise;

        $branches = Branche::where('supprimer_branche', '=', '0')
            ->where('id_entreprise', $entreprise)
            ->orderBy('created_at', 'DESC')
            ->get();
        // $branches = $this->branche->getBranches();

        return response()->json($branches);
    }

    /*
      |----------------------------------------------------
      | Liste des secteurs
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des secteurs.
      |
     */

    public function getSecteurs()
    {
        $secteurs = $this->secteur->getSecteurs();

        return response()->json($secteurs);
    }

    /*
      |----------------------------------------------------
      | Liste des roles
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des roles.
      |
     */

    public function getRoles()
    {
        $roles = $this->role->getRoles();

        return response()->json($roles);
    }

    /*
      |----------------------------------------------------
      | Liste des activités
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des activités.
      |
     */


    public function getLog()
    {
        $logs = $this->log->getLog();

        return response()->json($logs);
    }

    /*
      |----------------------------------------------------
      | Ajoût des localisations
      |----------------------------------------------------
      |
      | Cette fonction permet d'ajouter
      | des localisations.
      |
     */

    public function postLocalisations(Request $request)
    {
        // Récupération des données
        $data = $request->all();

        // Insertion dans la bdd
        $Data = $this->localisation->postLocalisations($data);

        return response()->json([
            'success' => true,
            'message' => 'Localisation enregistré avec succès',
            'localisation' => $Data
        ], Response::HTTP_OK);
    }

    public function postProfessions(Request $request)
    {
        // Récupération des données
        $data = $request->all();

        // Insertion dans la bdd
        $Data = $this->profession->postProfessions($data);

        return response()->json([
            'success' => true,
            'message' => 'Profession enregistré avec succès',
            'profession' => $Data
        ], Response::HTTP_OK);
    }

    public function postMarques(Request $request)
    {
        // Récupération des données
        $data = $request->all();

        // Insertion dans la bdd
        $Data = $this->marque->postMarques($data);

        return response()->json([
            'success' => true,
            'message' => 'Marque enregistré avec succès',
            'marque' => $Data
        ], Response::HTTP_OK);
    }

    public function postEnergies(Request $request)
    {
        // Récupération des données
        $data = $request->all();

        // Insertion dans la bdd
        $Data = $this->energie->postEnergies($data);

        return response()->json([
            'success' => true,
            'message' => 'Energie enregistré avec succès',
            'energie' => $Data
        ], Response::HTTP_OK);
    }

    public function postCouleurs(Request $request)
    {
        // Récupération des données
        $data = $request->all();

        // Insertion dans la bdd
        $Data = $this->couleur->postCouleurs($data);

        return response()->json([
            'success' => true,
            'message' => 'Couleur enregistré avec succès',
            'couleur' => $Data
        ], Response::HTTP_OK);
    }

    public function postCategories(Request $request)
    {
        // Récupération des données
        $data = $request->all();

        // Insertion dans la bdd
        $Data = $this->categorie->postCategories($data);

        return response()->json([
            'success' => true,
            'message' => 'Categorie enregistré avec succès',
            'categorie' => $Data
        ], Response::HTTP_OK);
    }

    public function postGenres(Request $request)
    {
        // Récupération des données
        $data = $request->all();

        // Insertion dans la bdd
        $Data = $this->genre->postGenres($data);

        return response()->json([
            'success' => true,
            'message' => 'Genre enregistré avec succès',
            'genre' => $Data
        ], Response::HTTP_OK);
    }

    public function postBranches(BrancheRequest $request)
    {
        // Validation du formulaire
        $validated = $request->validated();

        // Récupération des données
        $data = $request->all();

        // Insertion dans la bdd
        $Data = $this->branche->postBranches($data);

        if ($Data) {
            $branches = Branche::where('supprimer_branche', '=', '0')->orderBy('id_branche', 'DESC')->get();

            return response()->json([
                'success' => true,
                'message' => 'Genre enregistré avec succès',
                'genre' => $branches
            ], Response::HTTP_OK);
        }
    }
}
