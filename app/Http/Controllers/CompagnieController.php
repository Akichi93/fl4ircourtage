<?php

namespace App\Http\Controllers;

use App\Models\Branche;
use App\Models\Compagnie;
use Illuminate\Http\Request;
use App\Models\TauxCompagnie;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompagnieRequest;
use App\Repositories\CompagnieRepository;
use Symfony\Component\HttpFoundation\Response;

class CompagnieController extends Controller
{
    protected $compagnie;

    public function __construct(CompagnieRepository $compagnie)
    {
        $this->compagnie = $compagnie;
    }
    

    /*
      |----------------------------------------------------
      | Liste des compagnies 
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste de tous les compagnies pour une entreorises 
      | spécifique qvec la possibilité de faire une recherche.
      |
     */
    public function compagnieList(Request $request)
    {
        $data = strlen($request->q);
        if ($data > 0) {
            $compagnies['data'] = Compagnie::where('nom_compagnie', 'like', '%' . request('q') . '%')
                ->where('id_entreprise', Auth::user()->id_entreprise)
                ->where('supprimer_compagnie', '=', '0')
                ->orWhere('adresse_compagnie', 'like', '%' . request('q') . '%')
                ->orWhere('code_compagnie', 'like', '%' . request('q') . '%')
                ->get();
            return response()->json($compagnies);
        } else {
            $compagnies = Compagnie::where('id_entreprise', Auth::user()->id_entreprise)
                ->where('supprimer_compagnie', '=', '0')->latest()->paginate(10);
            return response()->json($compagnies);
        }
    }

    /*
      |----------------------------------------------------
      | Ajoût des compagnies
      |----------------------------------------------------
      |
      | Cette fonction permet d'ajouter
      | des compagnies.
      |
     */


    public function postCompagnie(CompagnieRequest $request)
    {
        // Validation du formulaire
        $validated = $request->validated();

        // Récupération des données
        $data = $request->all();

        // Insertion dans la bdd
        $Data = $this->compagnie->postCompagnie($data);

        return response()->json([
            'success' => true,
            'message' => 'Compagnie enregistré avec succès',
            'compagnie' => $Data
        ], Response::HTTP_OK);
    }

    public function editCompagnie(int $id_compagnie)
    {
        $compagnies = Compagnie::findOrFail($id_compagnie);
        return response()->json($compagnies);
    }

    public function deleteCompagnie(int $id_compagnie)
    {
        $Data = $this->compagnie->deleteCompagnie($id_compagnie);

        return response()->json([
            'success' => true,
            'data' => $Data
        ], Response::HTTP_OK);
    }

    public function updateCompagnie(int $id_compagnie)
    {
        $Data = $this->compagnie->updateCompagnie($id_compagnie);

        return response()->json([
            'success' => true,
            'data' => $Data
        ], Response::HTTP_OK);
    }

    public function getTauxCompagnie(Request $request)
    {
        $compagnies = TauxCompagnie::join("branches", 'taux_compagnies.id_branche', '=', 'branches.id_branche')
            ->where('taux_compagnies.id_compagnie', $request->compagnie)->get();
        return response()->json($compagnies);
    }

    public function getNameCompagnie(Request $request)
    {
        $names = Compagnie::select('nom_compagnie')->where('id_compagnie', $request->compagnie)->first();
        return response()->json($names);
    }

    public function editTauxCompagnie(Request $request, $id_tauxcomp)
    {
        $compagnies = TauxCompagnie::findOrFail($id_tauxcomp);
        return response()->json($compagnies);
    }

    public function getBrancheDiffCompagnie(Request $request)
    {
        // Branche de l'entreprise
        $getbranches = Branche::where('id_entreprise', Auth::user()->id_entreprise)->pluck('id_branche')->toArray();

        $result = TauxCompagnie::join("branches", 'taux_compagnies.id_branche', '=', 'branches.id_branche')
            ->where('taux_compagnies.id_compagnie', $request->compagnie)->pluck('branches.id_branche')->toArray();

        $array = array_diff($getbranches, $result);

        $branches = Branche::whereIn('id_branche', $array)->get();

        return response()->json($branches);
    }

    public function postTauxCompagnie(Request $request)
    {
        $data = $request->all();
        // Insertion dans la bdd
        $Data = $this->compagnie->postTauxCompagnie($data);

        return response()->json([
            'success' => true,
            'message' => 'Taux compagnie ajouté avec succès',
            'compagnie' => $Data
        ], Response::HTTP_OK);
    }

    public function updateTauxCompagnie(Request $request)
    {
        $data = $request->all();

        // Insertion dans la bdd
        $Data = $this->compagnie->updateTauxCompagnie($data);

        return response()->json([
            'success' => true,
            'message' => 'Taux compagnie modifié avec succès',
            'compagnie' => $Data
        ], Response::HTTP_OK);
    }

    public function getCompagnie()
    {
        $compagnies = $this->compagnie->getCompagnie();

        return response()->json($compagnies);
    }
}
