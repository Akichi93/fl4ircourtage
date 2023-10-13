<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Branche;
use App\Models\Prospect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BrancheProspect;
use Illuminate\Support\Facades\Auth;

class ProspectController extends Controller
{
    public function prospectList(Request $request)
    {
        $data = strlen($request->q);
        if ($data > 0) {
            $prospects['data'] = Prospect::where('nom_prospect', 'like', '%' . request('q') . '%')
                ->where('supprimer_prospect', '=', '0')
                ->where('id_entreprise', Auth::user()->id_entreprise)
                ->get();
            return response()->json($prospects);
        } else {
            $prospects = Prospect::where('id_entreprise', Auth::user()->id_entreprise)
                ->where('supprimer_prospect', '=', '0')
                ->latest()
                ->paginate(10);
            return response()->json($prospects);
        }
    }

    public function editProspect($id_prospect)
    {
        $prospects = Prospect::findOrFail($id_prospect);
        return response()->json($prospects);
    }

    public function postProspect(Request $request)
    {
        // dd($request->all());
        //validation
        $rules = [
            'civilite' => 'required',
            'nom_prospect' => 'required',
            'tel_prospect' => 'required|digits:10',
            'adresse_prospect' => 'required',
            'profession_prospect' => 'required',
        ];

        $customMessages = [
            'civilite.required' => 'Selectionnez la civilité',
            'nom_prospect.required' => 'Veuillez entrer le nom du prospect',
            'tel_prospect.required' => 'Veuillez entrer le contact de l\'apporteur',
            'tel_prospect.digits' => 'Veuillez entrer un contact de 10 chiffres',
            'adresse_prospect.required' => 'Veuillez entrer l\'adresse du prospect',
            'profession_prospect.required' => 'Veuillez entrer la profession du prospect',
        ];

        $this->validate($request, $rules, $customMessages);

        $prospects = new Prospect();
        $prospects->civilite = $request->civilite;
        $prospects->nom_prospect = $request->nom_prospect;
        $prospects->postal_prospect = $request->postal_prospect;
        $prospects->adresse_prospect = $request->adresse_prospect;
        $prospects->tel_prospect = $request->tel_prospect;
        $prospects->profession_prospect = $request->profession_prospect;
        $prospects->fax_prospect = $request->fax_prospect;
        $prospects->email_prospect = $request->email_prospect;
        $prospects->id_entreprise = Auth::user()->id_entreprise;
        $prospects->user_id = Auth::user()->id;
        $prospects->statut = $request->etat;
        $prospects->save();

        return response()->json($prospects);
    }

    public function updateProspect(Request $request, $id_prospect)
    {
        $prospects = Prospect::find($id_prospect);
        $prospects->civilite = request('civilite');
        $prospects->nom_prospect = request('nom_prospect');
        $prospects->postal_prospect = request('postal_prospect');
        $prospects->adresse_prospect = request('adresse_prospect');
        $prospects->tel_prospect = request('tel_prospect');
        $prospects->profession_prospect = request('profession_prospect');
        $prospects->fax_prospect = request('fax_prospect');
        $prospects->email_prospect = request('email_prospect');
        $prospects->save();

        return response()->json($prospects);
    }

    public function validateProspect(Request $request)
    {
        $id = $request->id_prospect;

        $prospects = Prospect::where('id_prospect', $id)->update([
            'etat' => 1,
        ]);

        $lastID = Client::max('id_client');
        if ($lastID == null) {
            $id = 1;
            $prefix = substr($request->nom_projet, 0, 2);
            $day = date('d');
            $month = date('m');
            $year = date('Y');
            $ref = '0' . '-' . $id . '-' . intval($month) . intval($day) . $year . strtoupper($prefix);
        } else {
            $id = intval($lastID) + 1;
            $prefix = substr($request->nom_projet, 0, 2);
            $day = date('d');
            $month = date('m');
            $year = date('Y');
            $ref = '0' . '-' . $id . '-' . intval($month) . intval($day) . $year . strtoupper($prefix);
        }


        $client = new Client();
        $client->numero_client = $ref;
        $client->civilite = $request->civilite;
        $client->nom_client = $request->nom_prospect;
        $client->tel_client = $request->tel_prospect;
        $client->postal_client = $request->postal_prospect;
        $client->adresse_client = $request->adresse_prospect;
        $client->profession_client = $request->profession_prospect;
        $client->fax_client = $request->fax_prospect;
        $client->email_client = $request->email_prospect;
        $client->id_entreprise = Auth::user()->id_entreprise;
        $client->save();

        return response()->json($prospects);
    }

    public function deleteProspect($id_prospect)
    {
        $prospects = Prospect::find($id_prospect);
        $prospects->supprimer_prospect = 1;
        $prospects->save();

        return response()->json($prospects);
    }

    public function etatProspect(Request $request, $id_prospect)
    {
        $prospects = Prospect::find($id_prospect);
        $prospects->statut = $request->etat;
        $prospects->save();

        return response()->json($prospects);
    }

    public function getBrancheDiffProspect(Request $request)
    {
        // Branche de l'entreprise
        $getbranches = Branche::where('id_entreprise', Auth::user()->id_entreprise)->pluck('id_branche')->toArray();

        $result = BrancheProspect::join("branches", 'branche_prospects.id_branche', '=', 'branches.id_branche')
            ->where('branche_prospects.id_prospect', $request->propsect)->pluck('branches.id_branche')->toArray();

        $array = array_diff($getbranches, $result);

        $branches = Branche::whereIn('id_branche', $array)->get();

        return response()->json($branches);
    }

    public function postBrancheProspect(Request $request)
    {

        $id_prospect = Prospect::where('id_entreprise', Auth::user()->id_entreprise)
            ->where('nom_prospect', $request->name)->pluck('id_prospect')->first();

        $prospects = new BrancheProspect();
        $prospects->id_branche = $request->id_branche;
        $prospects->id_prospect = $id_prospect;
        $prospects->description = $request->description;
        $prospects->save();

        return ['message' => 'Insertion avec succes'];
    }

    public function getNameProspect(Request $request)
    {
        $names = Prospect::select('nom_prospect')->where('id_prospect', $request->prospect)->first();
        return response()->json($names);
    }

    public function getBrancheProspect(Request $request)
    {
        $prospects = BrancheProspect::join("branches", 'branche_prospects.id_branche', '=', 'branches.id_branche')
            ->where('branche_prospects.id_prospect', $request->prospect)->get();
        return response()->json($prospects);
    }
}
