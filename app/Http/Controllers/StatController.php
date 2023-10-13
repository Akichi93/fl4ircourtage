<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Avenant;
use App\Models\Branche;
use App\Models\Contrat;
use App\Models\Prospect;
use App\Models\Sinistre;
use App\Models\Apporteur;
use App\Models\FileAvenant;
use App\Models\FileSinistre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Compagnie;
use Illuminate\Support\Facades\Auth;

class StatController extends Controller
{
    public function synthese()
    {
        $data['tables'] = Client::where('id_entreprise', Auth::user()->id_entreprise)
            ->where('supprimer_client', 0)
            ->get();

        return view('synthese', $data);
    }

    public function expiredata(Request $request)
    {

        $filtre = $request->filtre;
        $debut = $request->date_debut;
        $fin = $request->date_fin;
        // dd($fin);

        $data = strlen($request->search);

        if ($data > 0) {
            $contrats = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
                ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
                ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
                ->where('supprimer_contrat', '=', '0')
                ->where('nom_branche', 'like', '%' . request('search') . '%')
                ->orWhere('nom_client', 'like', '%' . request('search') . '%')
                ->orWhere('adresse_client', 'like', '%' . request('search') . '%')
                ->orWhere('profession_client', 'like', '%' . request('search') . '%')
                ->orWhere('nom_apporteur', 'like', '%' . request('search') . '%')
                ->orWhere('nom_compagnie', 'like', '%' . request('search') . '%')
                ->get();
            return response()->json($contrats);
        } else {
            if ($filtre == null) {
                $contrats = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                    ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
                    ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
                    ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
                    ->where('supprimer_contrat', '=', '0')
                    ->get();

                return response()->json($contrats);
            } elseif ($filtre == "expire") {
                $date = date('Y-m-d');

                $contrats =  Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                    ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
                    ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
                    ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
                    ->where('expire_le', '<', $date)
                    ->where('supprimer_contrat', 0)
                    ->where('contrats.id_entreprise', Auth::user()->id_entreprise)
                    ->get();

                return response()->json($contrats);
            } elseif ($filtre == "solde") {
                $contrats = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                    ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
                    ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
                    ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
                    ->where('solde', '=', '1')
                    ->where('supprimer_contrat', 0)
                    ->where('contrats.id_entreprise', Auth::user()->id_entreprise)
                    ->get();

                return response()->json($contrats);
            } elseif ($filtre == "nonsolde") {
                $contrats = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                    ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
                    ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
                    ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
                    ->where('solde', '=', '0')
                    ->where('supprimer_contrat', 0)
                    ->where('contrats.id_entreprise', Auth::user()->id_entreprise)
                    ->get();

                return response()->json($contrats);
            } else if ($filtre == "reverse") {
                $contrats = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                    ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
                    ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
                    ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
                    ->where('solde', '=', '1')
                    ->where('reverse', 0)
                    ->where('supprimer_contrat', 0)
                    ->where('contrats.id_entreprise', Auth::user()->id_entreprise)
                    ->get();

                return response()->json($contrats);
            } elseif ($fin != null) {


                $contrats =  Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                    ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
                    ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
                    ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
                    ->whereBetween('expire_le', [$debut, $fin])
                    ->where('supprimer_contrat', 0)
                    ->where('contrats.id_entreprise', Auth::user()->id_entreprise)
                    ->get();

                return response()->json($contrats);
            }
        }
    }

    public function detailsclient($id_client)
    {
        $clients = Client::findOrFail($id_client);

        $listescontrats = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->where('id_client', $clients->id_client)
            ->where('supprimer_contrat', 0)
            ->get();
        $listesinistres = Sinistre::join("contrats", 'sinistres.id_contrat', '=', 'contrats.id_contrat')
            ->where('id_client', $clients->id_client)
            ->where('supprimer_sinistre', 0)
            ->get();

        return view('customer.details', compact('clients', 'listescontrats', 'listesinistres'));
    }

    public function detailscontrats($id_contrat)
    {
        $contrats = Contrat::join("clients", 'contrats.id_client', '=', 'clients.id_client')->findOrFail($id_contrat);

        $files = FileAvenant::join("avenants", 'file_avenants.id_avenant', '=', 'avenants.id_avenant')->where('id_contrat', $id_contrat)->get();

        return view('voircontrat', compact('contrats', 'files'));
    }

    public function infosinistre($id_sinistre)
    {
        $sinistres = Sinistre::join("contrats", 'sinistres.id_contrat', '=', 'contrats.id_contrat')
            ->findOrFail($id_sinistre);

        $files = FileSinistre::join("sinistres", 'file_sinistres.id_sinistre', '=', 'sinistres.id_sinistre')->where('id_contrat', $id_sinistre)->get();

        return view('infosinistre', compact('sinistres', 'files'));
    }



    public function sinis()
    {

        $data['clients'] = Sinistre::join("contrats", 'sinistres.id_contrat', '=', 'contrats.id_contrat')
            ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->where('contrats.id_entreprise', Auth::user()->id_entreprise)
            ->get();

        return view('sinistre', $data);
    }

    public function productions()
    {
        $date = date('Y-m-d');

        $data['expires'] = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
            ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('expire_le', '<', $date)
            ->where('supprimer_contrat', 0)
            ->where('contrats.id_entreprise', Auth::user()->id_entreprise)
            ->get();

        $data['soldes'] = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
            ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('solde', '=', '1')
            ->where('supprimer_contrat', 0)
            ->where('contrats.id_entreprise', Auth::user()->id_entreprise)
            ->get();

        $data['nonsoldes'] = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
            ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('solde', '=', '0')
            ->where('supprimer_contrat', 0)
            ->where('contrats.id_entreprise', Auth::user()->id_entreprise)
            ->get();

        $data['nonreverses'] = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
            ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('solde', '=', '1')
            ->where('reverse', 0)
            ->where('supprimer_contrat', 0)
            ->where('contrats.id_entreprise', Auth::user()->id_entreprise)
            ->get();

        return view('production', $data);
    }

    public function statapporteur()
    {

        $data['apporteurs'] = Apporteur::where('id_entreprise', Auth::user()->id_entreprise)->where('supprimer_apporteur', 0)->get();
        return view('statapporteur', $data);
    }

    public function detailsapporteurs($id_apporteur)
    {
        $apporteurs = Apporteur::findOrFail($id_apporteur);

        $listescontrats = Contrat::select('nom_branche', 'numero_police', DB::raw('SUM(avenants.commission) as commission_apporteur'))
            ->join("avenants", 'contrats.id_contrat', '=', 'avenants.id_contrat')
            ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('contrats.id_apporteur', $apporteurs->id_apporteur)
            ->where('supprimer_contrat', 0)
            ->groupBy('numero_police')
            ->get();

        $sommes = Contrat::join("avenants", 'contrats.id_contrat', '=', 'avenants.id_contrat')
            ->where('contrats.id_apporteur', $apporteurs->id_apporteur)
            ->where('supprimer_contrat', 0)
            ->sum('commission');

        return view('apporteur.details', compact('apporteurs', 'listescontrats', 'sommes'));
    }

    public function statsupprime()
    {
        $data['clients'] = Client::where('supprimer_client', 1)->get();
        $data['prospects'] = Prospect::where('supprimer_prospect', 1)->get();
        $data['branches'] = Branche::where('supprimer_branche', 1)->get();
        $data['apporteurs'] = Apporteur::where('supprimer_apporteur', 1)->get();
        $data['compagnies'] = Compagnie::where('supprimer_compagnie', 1)->get();
        $data['contrats'] = Contrat::join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
            ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('supprimer_contrat', 1)
            ->get();
        $data['sinistres'] = Sinistre::join("contrats", 'sinistres.id_contrat', '=', 'contrats.id_contrat')
            ->where('supprimer_sinistre', 1)
            ->get();
        return view('delete', $data);
    }
}
