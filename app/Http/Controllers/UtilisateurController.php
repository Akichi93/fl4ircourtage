<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Prospect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::join("roles", 'roles.id_role', '=', 'users.id_role')
            ->where('id_entreprise', Auth::user()->id_entreprise)
            ->get();

        return response()->json($users);
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
        // //validation
        $rules = [
            'name' => 'required',
            'contact' => 'required|digits:10',
            'email' => 'required',
            'adresse' => 'required',
            'password' => 'required',
        ];

        $customMessages = [
            'name.required' => 'Entrez le nom svp',
            'email.required' => 'Veuillez entrer le contact de l\'apporteur',
            'contact.digits' => 'Veuillez entrer un contact de 10 chiffres',
            'contact.required' => 'Veuillez entrer un numéro',
            'adresse.required' => 'Veuillez entrer une adresse',
            'password.required' => 'Veuillez entrer un ùot de passe',
        ];

        $this->validate($request, $rules, $customMessages);

        // Encodage
        // Génération du mot de passe


        // try {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->contact = $request->contact;
        $user->adresse = $request->adresse;
        $user->id_role = $request->id_role;
        $user->id_entreprise = Auth::user()->id_entreprise;
        $user->save();

        // $to_email = $request->email;

        // // envoi de mail
        // if ($request->isMethod('post')) {
        //     $data = $request->all();

        //     $data = array(
        //         "body" => "Notification de création de projet",
        //         'email' => $data['email'],
        //         'password' => $random_password,
        //     );

        //     Mail::send('emails.users', $data, function ($message) use ($to_email) {
        //         $message->to($to_email)
        //             ->subject('Création de compte');
        //         $message->from('appliecommerce@gmail.com', 'FLAIR');
        //     });
        // }
        return response()->json(['message' => 'nsertion avec succes'], 200);
        // } catch (\Exception $exception) {
        //     die("Impossible de se connecter à la base de données.  Veuillez vérifier votre configuration. erreur:" . $exception);
        //     return response()->json(['message' => 'Apporteur non enregistré'], 422);
        // }
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
        $users = User::findOrFail($id);
        return response()->json($users);
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
        $user = User::find($id);
        $user->name = request('name');
        $user->email = request('email');
        $user->contact = request('contact_user');
        $user->save();
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

    public function getLogs(Request $request)
    {
        $users = User::join("roles", 'roles.id_role', '=', 'users.id_role')
            ->where('id', $request->user)
            ->first();

        $prospects = Prospect::where('user_id', $request->user)
            ->where('etat', 0)
            ->get();

        $clients = Client::where('user_id', $request->user)
            ->get();

        return response()->json(["users" => $users, "prospects" => $prospects, "clients" => $clients]);
    }

    public function getRole()
    {
        $roles = User::join("roles", 'roles.id_role', '=', 'users.id_role')->where('id', Auth::user()->id)
            ->pluck('nom_role');

        return response()->json($roles);
    }
}
