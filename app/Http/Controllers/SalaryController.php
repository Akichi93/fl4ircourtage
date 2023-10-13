<?php

namespace App\Http\Controllers\Admin;

use App\Models\Salary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salaries = Salary::where('id_entreprise', Auth::user()->id_entreprise)->get();

        return response()->json($salaries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $salaries = new Salary();
        $salaries->nom = $request->nom;
        $salaries->prenom = $request->prenom;
        $salaries->sexe = $request->sexe;
        $salaries->renumeration = $request->renumeration;
        $salaries->date_naissance = $request->date_naissance;
        $salaries->date_embauche = $request->date_embauche;
        $salaries->secteur = $request->secteur;
        $salaries->id_entreprise = Auth::user()->id_entreprise;
        $salaries->user_id = Auth::user()->id;
        $salaries->save();
        return response()->json($salaries);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function salairemoyen()
    {
        $salaire = Salary::sum('renumeration');
        $nbre = Salary::count();

        if ($nbre == 0) {
            $moyen = 0;
        } else {
            $moyen = $salaire / $nbre;
        }



        return response()->json($moyen);
    }

    public function nbresalaire()
    {
        $nbre = Salary::count();

        return response()->json($nbre);
    }

    public function massesalariale()
    {
        $masse = Salary::sum('renumeration');

        return response()->json($masse);
    }
}
