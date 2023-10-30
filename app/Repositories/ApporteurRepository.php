<?php

namespace App\Repositories;

use App\Models\Apporteur;
use App\Models\TauxApporteur;
use Illuminate\Support\Facades\Auth;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class ApporteurRepository.
 */
class ApporteurRepository extends BaseRepository
{
    protected $apporteurs;

    public function __construct(Apporteur $apporteurs)
    {
        $this->apporteurs = $apporteurs;
    }
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public function postApporteur(array $data)
    {
        // try {

        $apporteur = $data['nom_apporteur'];
        if (Apporteur::where('nom_apporteur', '=', $apporteur)->count() > 0) {
            return response()->json(['message' => 'Apporteur existant'], 422);
        } else {
            // $lastID = Apporteur::max('id_apporteur');
            // if ($lastID == null) {
            //     $id = 1;
            //     $day = date('d');
            //     $month = date('m');
            //     $year = date('Y');
            //     $a = "AP";
            //     $ref = $a . '-' . $id . '-' . intval($month) . intval($day) . $year;
            // } else {
            //     $id = intval($lastID) + 1;
            //     $day = date('d');
            //     $month = date('m');
            //     $year = date('Y');
            //     $a = "AP";
            //     $ref = $a . '-' . $id . '-' . $month . $day . $year;
            // }
            $ref= "AB@#$";

          

            $all = $data;
            $apporteurs = new Apporteur();
            $apporteurs->nom_apporteur = $data['nom_apporteur'];
            $apporteurs->contact_apporteur = $data['contact_apporteur'];
            $apporteurs->email_apporteur = $data['email_apporteur'];
            $apporteurs->adresse_apporteur = $data['adresse_apporteur'];
            $apporteurs->code_postal = $data['code_postal'];
            $apporteurs->code_apporteur =   $ref;
            $apporteurs->id_entreprise = $data['id_entreprise'];
            $apporteurs->user_id = $data['id'];
            $apporteurs->apporteur_url = bcrypt($ref);
            $apporteurs->save();

            $id = $apporteurs->id_apporteur;

            $leads = $all['accidents'];  // valeur
            $firsts = $all['ids']; // id

            $array = array_combine($firsts, $leads);

            foreach ($array as $key => $value) {
                $taux = new TauxApporteur();
                $taux->taux = $value;
                $taux->id_branche = $key;
                $taux->id_apporteur = $apporteurs['id_apporteur'];
                $taux->save();
            }

            return $apporteurs;

            //     return ['message' => 'Insertion avec succes'];
            // } catch (\Exception $exception){
            //     die("Impossible de se connecter à la base de données.  Veuillez vérifier votre configuration. erreur:" . $exception );
            //     return response()->json(['message' => 'Apporteur non enregistré'], 422);
            // }
        }
    }

    public function editApporteur($id_apporteur)
    {
        return Apporteur::findOrFail($id_apporteur);
    }

    public function deleteApporteur(int $id_apporteur)
    {
        $apporteurs = Apporteur::find($id_apporteur);
        $apporteurs->supprimer_apporteur = 1;
        $apporteurs->save();

        return $apporteurs;
    }


    public function updateApporteur(int $id_apporteur)
    {
        $apporteur = Apporteur::find($id_apporteur);
        $apporteur->nom_apporteur = request('nom_apporteur');
        $apporteur->email_apporteur = request('email_apporteur');
        $apporteur->contact_apporteur = request('contact_apporteur');
        $apporteur->adresse_apporteur = request('adresse_apporteur');
        $apporteur->code_postal = request('code_postal');
        $apporteur->save();

        return $apporteur;
    }

    public function editTauxApporteur($id_tauxapp)
    {
        return TauxApporteur::where('id_tauxapp',$id_tauxapp)->first();
    }

    public function postTauxApporteur(array $data)
    {

        $id_apporteur = Apporteur::where('id_entreprise', Auth::user()->id_entreprise)
            ->where('nom_apporteur', $data['name'])->pluck('id_apporteur')->first();

        $leads = $data['accidents'];  // valeur
        $firsts = $data['ids']; // id

        $array = array_combine($firsts, $leads);

        foreach ($array as $key => $value) {
            $taux = new TauxApporteur();
            $taux->taux = $value;
            $taux->id_branche = $key;
            $taux->id_apporteur = $id_apporteur;
            $taux->save();
        }

        return $id_apporteur;
    }

    public function updateTauxApporteur(array $data)
    {
        $id_tauxapp = $data['id_tauxapp'];
        $taux = $data['taux'];
        $apporteurs = TauxApporteur::where('id_tauxapp', $id_tauxapp)->update(['taux' => $taux]);

        return $apporteurs;
    }

    public function getApporteur()
    {
        $apporteurs = Apporteur::orderBy('id_apporteur', 'DESC')
            ->where('id_entreprise', Auth::user()->id_entreprise)
            ->where('supprimer_apporteur', 0)->get();

        return $apporteurs;
    }
}
