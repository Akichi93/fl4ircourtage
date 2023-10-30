<?php

namespace App\Http\Controllers;

use App\Models\Branche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrancheController extends Controller
{
    public function branchesList(Request $request)
    {
        $data = strlen($request->q);

        if ($data > 0) {
            $branches['data'] =  Branche::where('supprimer_branche', '=', '0')
                ->where('nom_branche', 'like', '%' .request('q') . '%')
                ->get();
            return response()->json($branches);
        } else {
            $branches = Branche::where('supprimer_branche', '=', '0')->orderBy('id_branche','DESC')->get();
            return response()->json($branches);
        }
    }
    public function editBranche($id_branche)
    {
        $branches = Branche::findOrFail($id_branche);
        return response()->json($branches);
    }


    public function updateBranche(Request $request, $id_branche)
    {
        $branches = Branche::find($id_branche);
        $branches->nom_branche = $request->nom_branche;
        $branches->save();

        if($branches){
            $branches = Branche::where('supprimer_branche', '=', '0')->orderBy('id_branche', 'DESC')->get();

            return response()->json($branches);
        }

        
    }

    public function deleteBranche($id_branche)
    {
        $branches = Branche::find($id_branche);
        $branches->supprimer_branche = 1;
        $branches->save();

        if($branches){
            $branches = Branche::where('supprimer_branche', '=', '0')->orderBy('id_branche', 'DESC')->get();

            return response()->json($branches);
        }
    }

    private function refresh()
    {
        $branches = Branche::where('supprimer_branche', '=', '0')->orderBy('id_branche','DESC')->get();
            return response()->json($branches);
    }
}
