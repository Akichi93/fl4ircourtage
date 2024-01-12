<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class SyncController extends Controller
{
    public function syncBranche(Request $request)
    {

        // Recuperer user
        $user =  JWTAuth::parseToken()->authenticate();

        $user->id_entreprise;

        // Données à synchroniser
        $data = $request->all();


        dd($data);



        if($data){

        }
        
    }

    public function syncProspect()
    {
    }

    public function syncClient()
    {
    }
}
