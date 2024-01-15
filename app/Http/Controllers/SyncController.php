<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Branche;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;

class SyncController extends Controller
{

    public function syncClient(Request $request)
    {
        // Recuperer user
        $user =  JWTAuth::parseToken()->authenticate();

        // Données à synchroniser
        $data = $request->all();


        foreach ($data as $clientData) {
            // Use Carbon for date manipulation
            $day = Carbon::now()->day;
            $month = Carbon::now()->month;
            $year = Carbon::now()->year;

            // Generate reference
            $ref = strtoupper(substr($clientData['nom_client'], 0, 3) . '-' . intval($month) . intval($day) . $year);

            // Create and save client record using mass assignment
            $client = new Client($clientData);
            $client->sync = 1;
            $client->id_entreprise = $clientData['id_entreprise'];
            $client->numero_client = $ref;
            $client->save();
        }
    }

    public function syncBranche(Request $request)
    {

        // Recuperer user
        $user =  JWTAuth::parseToken()->authenticate();

        // Données à synchroniser
        $data = $request->all();

        // Création de l'enregistrement avec la méthode create
        $branche = Branche::create($data);

        // Mise à jour de la valeur de sync à 1
        $branche->update(['sync' => 1]);

        if ($branche) {
            $branches = Branche::where('id_entreprise', $user->id_entreprise)->latest();

            return response()->json($branches);
        }
    }

    public function syncProspect()
    {
    }

    public function syncCompagnie(){

    }

    public function syncApporteur(){
        
    }
}
