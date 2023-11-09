<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Avenant;
use App\Models\Branche;
use App\Models\Contrat;
use App\Models\Prospect;
use App\Models\Sinistre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class HomeController extends Controller
{
    public function stat(Request $request)
    {
        $year = Avenant::where('id_avenant', $request->year)->pluck('annee')->first();
        // $year = $request->year;
        $branch = $request->branch;

        if ($branch == null) {
            // Année actuelle
            $Year = date("Y");
            // Date du jour
            $date = date('Y-m-d');
            $user =  JWTAuth::parseToken()->authenticate();
            $entreprise = $user->id_entreprise;

            $contrats = Contrat::where('expire_le', '>', $date)
                ->whereYear('souscrit_le', '=', $Year)
                ->where('id_entreprise', $entreprise)
                ->where('supprimer_contrat', '=', 0)
                ->count();

            $prospects = Prospect::where('etat', 0)
                ->whereYear('created_at', '=', $Year)
                ->where('id_entreprise', $entreprise)
                ->where('supprimer_prospect', '=', 0)
                ->count();

            $clients = Client::where('id_entreprise', $entreprise)->count();

            $sinistres = Sinistre::where('etat', '0')
                ->whereYear('date_survenance', '=', $Year)
                ->where('id_entreprise', $entreprise)
                ->where('supprimer_sinistre', '=', 0)
                ->count();

            // Commission apporteur
            $comissionapporteur = Contrat::whereYear('souscrit_le', '=', $Year)
                ->where('id_entreprise', $entreprise)
                ->where('supprimer_contrat', '=', 0)
                ->sum('commission_apporteur');

            // Commission courtier
            $comissioncourtier = Contrat::whereYear('souscrit_le', '=', $Year)
                ->where('id_entreprise', $entreprise)
                ->where('supprimer_contrat', '=', 0)
                ->sum('commission_courtier');


            // Nbre de contrats à echeance
            $exp = Carbon::now()->subDays(15);
            $echeance = DB::table('contrats')->whereDate('expire_le', '< ', $exp)
                ->whereYear('souscrit_le', '=', $Year)
                ->where('id_entreprise', $entreprise)
                ->where('supprimer_contrat', '=', 0)
                ->count();

            $prime = Avenant::where('annee', $Year)
                ->where('id_entreprise', $entreprise)
                ->where('supprimer_avenant', '=', 0)
                ->sum('prime_nette');

            $accesoire = Avenant::where('annee', $Year)
                ->where('id_entreprise', $entreprise)
                ->where('supprimer_avenant', '=', 0)
                ->sum('accessoires');

            $countemission = $prime + $accesoire;

            return response()->json(["contrat" => $contrats, "prospect" => $prospects, "client" => $clients, "sinistre" => $sinistres, "comissioncourtier" => $comissioncourtier, "comissionapporteur" => $comissionapporteur, "echeance" => $echeance, "countemission" => $countemission]);
        } elseif ($branch == "tous") {
            $year = Avenant::where('id_avenant', $request->year)->pluck('annee')->first();
            $Year = date("Y");
            // Date du jour
            $date = date('Y-m-d');
            $user =  JWTAuth::parseToken()->authenticate();
            $entreprise = $user->id_entreprise;

            $contrats = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                ->where('expire_le', '>', $date)
                ->whereYear('contrats.created_at', '=', $year)
                ->where('contrats.id_entreprise', $entreprise)
                ->where('supprimer_contrat', '=', 0)
                ->count();

            $prospects = Prospect::where('etat', 0)
                ->where('prospects.id_entreprise', $entreprise)
                ->where('supprimer_prospect', '=', 0)
                ->whereYear('created_at', '=', $year)
                ->count();

            $clients = Client::where('id_entreprise', $entreprise)
                ->whereYear('created_at', '=', $year)
                ->count();

            $sinistres = Sinistre::where('etat', '0')
                ->whereYear('date_survenance', '=', $Year)
                ->whereYear('created_at', '=', $year)
                ->where('id_entreprise', $entreprise)
                ->where('supprimer_sinistre', '=', 0)
                ->count();

            // Commission apporteur
            $comissionapporteur = Contrat::whereYear('souscrit_le', '=', $Year)
                ->whereYear('created_at', '=', $year)
                ->where('id_entreprise', $entreprise)
                ->where('supprimer_contrat', '=', 0)
                ->sum('commission_apporteur');

            // Commission courtier
            $comissioncourtier = Contrat::whereYear('souscrit_le', '=', $Year)
                ->whereYear('created_at', '=', $year)
                ->where('id_entreprise', $entreprise)
                ->where('supprimer_contrat', '=', 0)
                ->sum('commission_courtier');


            // Nbre de contrats à echeance
            $exp = Carbon::now()->subDays(15);
            $echeance = DB::table('contrats')->whereDate('expire_le', '< ', $exp)
                ->whereYear('created_at', '=', $year)
                ->whereYear('souscrit_le', '=', $Year)
                ->where('id_entreprise', $entreprise)
                ->where('supprimer_contrat', '=', 0)
                ->count();

            $prime = Avenant::where('annee', $Year)
                ->whereYear('created_at', '=', $year)
                ->where('id_entreprise', $entreprise)
                ->sum('prime_nette');

            $accesoire = Avenant::where('annee', $Year)
                ->where('id_entreprise', $entreprise)
                ->sum('accessoires');

            $countemission = $prime + $accesoire;

            return response()->json(["contrat" => $contrats, "prospect" => $prospects, "client" => $clients, "sinistre" => $sinistres, "comissioncourtier" => $comissioncourtier, "comissionapporteur" => $comissionapporteur, "echeance" => $echeance, "countemission" => $countemission]);
        } else {
            $year = Avenant::where('id_avenant', $request->year)->pluck('annee')->first();
            $Year = date("Y");
            // Date du jour
            $date = date('Y-m-d');
            $user =  JWTAuth::parseToken()->authenticate();
            $entreprise = $user->id_entreprise;

            $contrats = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                ->where('expire_le', '>', $date)
                ->whereYear('contrats.effet_police', '=', $year)
                ->where('contrats.id_branche', '=', $branch)
                ->where('contrats.id_entreprise', $entreprise)
                ->count();

            $prospects = Prospect::where('etat', 0)
                ->where('prospects.id_entreprise', $entreprise)
                ->whereYear('created_at', '=', $year)
                ->count();

            $clients = Client::where('id_entreprise', $entreprise)
                ->whereYear('created_at', '=', $year)
                ->count();

            $sinistres = Sinistre::join("contrats", 'sinistres.id_contrat', '=', 'contrats.id_contrat')
                ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                ->where('etat', '0')
                ->whereYear('date_survenance', '=', $year)
                ->where('contrats.id_branche', '=', $branch)
                ->where('sinistres.id_entreprise', $entreprise)
                ->count();

            // Commission apporteur
            $comissionapporteur = Contrat::whereYear('effet_police', '=', $year)
                ->where('contrats.id_branche', '=', $branch)
                ->where('id_entreprise', $entreprise)
                ->where('supprimer_contrat', '=', 0)
                ->sum('commission_apporteur');

            // Commission courtier
            $comissioncourtier = Contrat::whereYear('effet_police', '=', $year)
                ->where('contrats.id_branche', '=', $branch)
                ->where('id_entreprise', $entreprise)
                ->where('supprimer_contrat', '=', 0)
                ->sum('commission_courtier');


            // Nbre de contrats à echeance
            $exp = Carbon::now()->subDays(60);
            $echeance = DB::table('contrats')->whereDate('expire_le', '< ', $exp)
                ->whereYear('effet_police', '=', $year)
                ->where('id_branche', '=', $branch)
                ->where('id_entreprise', $entreprise)
                ->count();

            $prime = Avenant::join("contrats", 'avenants.id_contrat', '=', 'contrats.id_contrat')
                ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                ->where('annee', $year)
                ->where('branches.id_branche', '=', $branch)
                ->where('avenants.id_entreprise', $entreprise)
                ->where('supprimer_contrat', '=', 0)
                ->sum('avenants.prime_nette');

            $accesoire = Avenant::join("contrats", 'avenants.id_contrat', '=', 'contrats.id_contrat')
                ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                ->where('annee', $year)
                ->where('branches.id_branche', '=', $branch)
                ->where('avenants.id_entreprise', $entreprise)
                ->where('supprimer_contrat', '=', 0)
                ->sum('avenants.accessoires');

            $countemission = $prime + $accesoire;

            return response()->json([
                "contrat" => $contrats, "prospect" => $prospects, "client" => $clients,
                "sinistre" => $sinistres, "comissioncourtier" => $comissioncourtier, "comissionapporteur" => $comissionapporteur,
                "echeance" => $echeance, "countemission" => $countemission
            ]);
        }
    }

    public function year()
    {
        $user =  JWTAuth::parseToken()->authenticate();
       
        $entreprise = $user->id_entreprise;
        $getYear = Avenant::select('annee')->where('id_entreprise', $entreprise)->groupBy('annee')->get();
        return response()->json($getYear);
    }

    public function retrievebranche()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $entreprise = $user->id_entreprise;
        $branches = Branche::where('id_entreprise', $entreprise)->where('supprimer_branche', 0)->get();

        return response()->json($branches);
    }

    public function getexpires()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $date = date('Y-m-d');

        $expires = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
            ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('expire_le', '<', $date)
            ->where('contrats.id_entreprise', $user->id_entreprise)
            ->get();

        return response()->json($expires);
    }

    public function getnonsoldes()
    {
        $user =  JWTAuth::parseToken()->authenticate();

        $nonsoldes = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
            ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('supprimer_contrat', 0)
            ->where('solde', '=', '0')
            ->where('contrats.id_entreprise', $user->id_entreprise)
            ->get();

        return response()->json($nonsoldes);
    }

    public function getsoldes()
    {
        $user =  JWTAuth::parseToken()->authenticate();

        $soldes = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
            ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('supprimer_contrat', 0)
            ->where('solde', '=', '1')
            ->where('contrats.id_entreprise', $user->id_entreprise)
            ->get();

        return response()->json($soldes);
    }

    public function getnonreverses()
    {
        $user =  JWTAuth::parseToken()->authenticate();

        $nonreverses = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
            ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('supprimer_contrat', 0)
            ->where('solde', '=', '1')
            ->where('reverse', 0)
            ->where('contrats.id_entreprise', $user->id_entreprise)
            ->get();

        return response()->json($nonreverses);
    }


    public function searchexpires(Request $request)
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $date = date('Y-m-d');

        $expires = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
            ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('supprimer_contrat', 0)
            ->where('expire_le', '<', $date)
            ->whereBetween('souscrit_le', [$request->debut, $request->fin])
            ->orwhereBetween('expire_le', [$request->debut, $request->fin])
            ->orwhereBetween('effet_police', [$request->debut, $request->fin])
            ->where('contrats.id_entreprise', $user->id_entreprise)
            ->get();

        return response()->json($expires);
    }

    public function searchnonsolde(Request $request)
    {
        $user =  JWTAuth::parseToken()->authenticate();

        $nonsoldes = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
            ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('supprimer_contrat', 0)
            ->where('solde', '=', '0')
            ->whereBetween('souscrit_le', [$request->debutnon, $request->finnon])
            ->orwhereBetween('expire_le', [$request->debutnon, $request->finnon])
            ->orwhereBetween('effet_police', [$request->debutnon, $request->finnon])
            ->where('contrats.id_entreprise', $user->id_entreprise)
            ->get();

        return response()->json($nonsoldes);
    }

    public function searchsolde(Request $request)
    {
        $user =  JWTAuth::parseToken()->authenticate();

        $soldes = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
            ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('supprimer_contrat', 0)
            ->where('solde', '=', '0')
            ->whereBetween('souscrit_le', [$request->debutsolde, $request->finsolde])
            ->orwhereBetween('expire_le', [$request->debutsolde, $request->finsolde])
            ->orwhereBetween('effet_police', [$request->debutsolde, $request->finsolde])
            ->where('contrats.id_entreprise', $user->id_entreprise)
            ->get();

        return response()->json($soldes);
    }

    public function searchnonreverse(Request $request)
    {
        $user =  JWTAuth::parseToken()->authenticate();

        $nonreverses = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
            ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('solde', '=', '0')
            ->whereBetween('souscrit_le', [$request->nonreverse_debut, $request->nonreverse_fin])
            ->orwhereBetween('expire_le', [$request->nonreverse_debut, $request->nonreverse_fin])
            ->orwhereBetween('effet_police', [$request->nonreverse_debut, $request->nonreverse_fin])
            ->where('contrats.id_entreprise', $user->id_entreprise)
            ->get();

        return response()->json($nonreverses);
    }
}
