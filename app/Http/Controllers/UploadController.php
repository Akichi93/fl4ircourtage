<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Branche;
use App\Models\Prospect;
use App\Models\Sinistre;
use App\Models\Apporteur;
use Illuminate\Http\Request;
use App\Models\TauxApporteur;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function importclient(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'import_client' => ['file']
        // ]);

        // if (!empty($request->import_client)) {
        //     $file = $request->import_client;
        //     $rows  = array_map("str_getcsv", file($file, FILE_SKIP_EMPTY_LINES));
        //     $header = array_shift($rows);
        //     $f = fopen($file, "r");
        //     $firstLine = fgets($f);
        //     //get first line of csv file
        //     fclose($f); // close file
        //     $foundHeaders = str_getcsv(trim($firstLine), ',', '"'); //parse to array

        //     $requiredHeaders = array('civilite', 'nom_client', 'postal_client', 'adresse_client', 'tel_client', 'profession_client', 'fax_client', 'email_client', 'numero_client');


        //     if ($foundHeaders !== $requiredHeaders) {
        //         echo 'Headers do not match: ' . implode(', ', $foundHeaders);
        //         return back()->with('success', 'Veuillez entrer la bonne base');
        //     } else {
        //         $file = $request->import_client;

        //         // Open uploaded CSV file with read-only mode
        //         $csvFile  = fopen($file, "r");

        //         // Skip the first line
        //         fgetcsv($csvFile);

        //         // Parse data from CSV file line by line
        //         while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE) {
        //             // Get row data
        //             $civilite[] = $getData[0];
        //             $nom_client[] = $getData[1];
        //             $postal_client[] = $getData[2];
        //             $adresse_client[] = $getData[3];
        //             $tel_client[] = $getData[4];
        //             $profession_client[] = $getData[5];
        //             $fax_client[] = $getData[6];
        //             $email_client[] = $getData[7];
        //             $numero_client[] = $getData[8];
        //             $id_entreprise[] = Auth::user()->id_entreprise;
        //             $user_id[] = Auth::user()->id;


        //             $pcreate_data[] =
        //                 array(
        //                     'civilite' => $getData[0],
        //                     'nom_client' => $getData[1],
        //                     'postal_client' => $getData[2],
        //                     'adresse_client' => $getData[3],
        //                     'tel_client' => $getData[4],
        //                     'profession_client' => $getData[5],
        //                     'fax_client' => $getData[6],
        //                     'email_client' => $getData[7],
        //                     'numero_client' => $getData[8],
        //                     'id_entreprise' =>  Auth::user()->id_entreprise,
        //                     'user_id' =>  Auth::user()->id,

        //                 );
        //         }

        //         foreach ($pcreate_data as $data) {
        //             Client::create($data);
        //         }

        //         return back()->with('success', 'Base de donnees clients importes');
        //     }
        // }
    }

    public function importprospect(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'import_prospect' => ['file']
        ]);

        if (!empty($request->import_prospect)) {
            $file = $request->import_prospect;
            $rows  = array_map("str_getcsv", file($file, FILE_SKIP_EMPTY_LINES));
            $header = array_shift($rows);
            $f = fopen($file, "r");
            $firstLine = fgets($f); //get first line of csv file
            fclose($f); // close file
            $foundHeaders = str_getcsv(trim($firstLine), ',', '"'); //parse to array

            $requiredHeaders = array('civilite', 'nom_prospect', 'postal_prospect', 'adresse_prospect', 'tel_prospect', 'profession_prospect', 'fax_prospect', 'email_prospect');



            if ($foundHeaders !== $requiredHeaders) {
                echo 'Headers do not match: ' . implode(', ', $foundHeaders);
                return back()->with('success', 'Veuillez entrer la bonne base');
            } else {

                $file = $request->import_prospect;



                // Open uploaded CSV file with read-only mode
                $csvFile  = fopen($file, "r");



                // Skip the first line
                fgetcsv($csvFile);

                // Parse data from CSV file line by line
                while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE) {
                    // Get row data
                    $civilite[] = $getData[0];
                    $nom_prospect[] = $getData[1];
                    $postal_prospect[] = $getData[2];
                    $adresse_prospect[] = $getData[3];
                    $tel_prospect[] = $getData[4];
                    $profession_prospect[] = $getData[5];
                    $fax8prospect[] = $getData[6];
                    $email_prospect[] = $getData[7];
                    $id_entreprise[] = Auth::user()->id_entreprise;
                    $user_id[] = Auth::user()->id;


                    $pcreate_data[] =
                        array(
                            'civilite' => $getData[0],
                            'nom_prospect' => $getData[1],
                            'postal_prospect' => $getData[2],
                            'adresse_prospect' => $getData[3],
                            'tel_prospect' => $getData[4],
                            'profession_prospect' => $getData[5],
                            'fax_prospect' => $getData[6],
                            'email_prospect' => $getData[7],
                            'etat' => 0,
                            'id_entreprise' =>  Auth::user()->id_entreprise,
                            'user_id' =>  Auth::user()->id,

                        );
                }

                foreach ($pcreate_data as $data) {
                    Prospect::create($data);
                }

                return back()->with('success', 'Base de donnees prospect importes');
            }
        }
    }

    public function importbranche(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'import_branche' => ['file']
        ]);

        if (!empty($request->import_branche)) {
            $file = $request->import_branche;
            $rows  = array_map("str_getcsv", file($file, FILE_SKIP_EMPTY_LINES));
            $header = array_shift($rows);
            $f = fopen($file, "r");
            $firstLine = fgets($f); //get first line of csv file
            fclose($f); // close file
            $foundHeaders = str_getcsv(trim($firstLine), ',', '"'); //parse to array

            $requiredHeaders = array('nom_branche');



            if ($foundHeaders !== $requiredHeaders) {
                echo 'Headers do not match: ' . implode(', ', $foundHeaders);
                return back()->with('success', 'Veuillez entrer la bonne base');
            } else {

                $file = $request->import_branche;



                // Open uploaded CSV file with read-only mode
                $csvFile  = fopen($file, "r");



                // Skip the first line
                fgetcsv($csvFile);

                // Parse data from CSV file line by line
                while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE) {
                    // Get row data
                    $nom_branche[] = $getData[0];
                    $id_entreprise[] = Auth::user()->id_entreprise;
                    $user_id[] = Auth::user()->id;


                    $pcreate_data[] =
                        array(
                            'nom_branche' => strtoupper($getData[0]),
                            'id_entreprise' =>  Auth::user()->id_entreprise,
                            'user_id' =>  Auth::user()->id,

                        );
                }

                foreach ($pcreate_data as $data) {
                    Branche::create($data);
                }

                return back()->with('success', 'Base de donnees prospect importes');
            }
        }
    }

    public function importapporteur(Request $request)
    {
        $request->validate([
            'import_apporteur' => ['file']
        ]);

        if (!empty($request->import_apporteur)) {
            $file = $request->import_apporteur;
            $rows  = array_map("str_getcsv", file($file, FILE_SKIP_EMPTY_LINES));
            $header = array_shift($rows);
            $f = fopen($file, "r");
            $firstLine = fgets($f); //get first line of csv file
            fclose($f); // close file
            $foundHeaders = str_getcsv(trim($firstLine), ',', '"'); //parse to array

            $requiredHeaders = array('nom_apporteur', 'email_apporteur', 'adresse_apporteur', 'contact_apporteur', 'code_apporteur', 'code_postal');

            if ($foundHeaders !== $requiredHeaders) {
                echo 'Headers do not match: ' . implode(', ', $foundHeaders);
                return back()->with('success', 'Veuillez entrer la bonne base');
            } else {

                $file = $request->import_apporteur;



                // Open uploaded CSV file with read-only mode
                $csvFile  = fopen($file, "r");



                // Skip the first line
                fgetcsv($csvFile);

                // Parse data from CSV file line by line
                while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE) {


                    $pcreate_data[] =
                        array(
                            'nom_apporteur' => $getData[0],
                            'email_apporteur' => $getData[1],
                            'adresse_apporteur' => $getData[2],
                            'contact_apporteur' => $getData[3],
                            'code_apporteur' => $getData[4],
                            'code_postal' => $getData[5],
                            'id_entreprise' =>  Auth::user()->id_entreprise,
                            'user_id' =>  Auth::user()->id,
                        );
                }

                foreach ($pcreate_data as $data) {
                    Apporteur::create($data);
                }

                return back()->with('success', 'Base de donnees clients importes');
            }
        }
    }

    public function importauxapporteur(Request $request)
    {
        $request->validate([
            'import_tauxapporteur' => ['file']
        ]);

        if (!empty($request->import_tauxapporteur)) {
            $file = $request->import_tauxapporteur;
            $rows  = array_map("str_getcsv", file($file, FILE_SKIP_EMPTY_LINES));
            $header = array_shift($rows);
            $f = fopen($file, "r");
            $firstLine = fgets($f); //get first line of csv file
            fclose($f); // close file
            $foundHeaders = str_getcsv(trim($firstLine), ',', '"'); //parse to array

            $requiredHeaders = array('code_apporteur', 'nom_branche', 'taux',);

            if ($foundHeaders !== $requiredHeaders) {
                echo 'Headers do not match: ' . implode(', ', $foundHeaders);
                return back()->with('success', 'Veuillez entrer la bonne base');
            } else {


                // Parse data from CSV file line by line
                $filePath = $request->import_tauxapporteur;
                $file = fopen($filePath, 'r');

                $header = fgetcsv($file);

                $tauxapporteur = [];
                while ($row = fgetcsv($file)) {
                    $tauxapporteur[] = array_combine($header, $row);
                }

                fclose($file);

                return view('parametre.upload', compact('tauxapporteur'));
            }
        }
    }

    public function validatetauxapporteur(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();


            foreach ($data['attrId'] as $key => $attr) {
                if (!empty($attr)) {
                    TauxApporteur::create(['id_apporteur' => $data['id_apporteur'][$key], 'id_branche' => $data['id_branche'][$key], 'taux' => $data['taux'][$key]]);
                }
            }

            return view('parametre.upload')->with('success', 'Base de donnees taux apporteurs importes');
        }
    }

    public function importcompagnie(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'import_apporteur' => ['file']
        ]);

        if (!empty($request->import_compagnie)) {
            $file = $request->import_compagnie;
            $rows  = array_map("str_getcsv", file($file, FILE_SKIP_EMPTY_LINES));
            $header = array_shift($rows);
            $f = fopen($file, "r");
            $firstLine = fgets($f); //get first line of csv file
            fclose($f); // close file
            $foundHeaders = str_getcsv(trim($firstLine), ',', '"'); //parse to array

            $requiredHeaders = array('nom_compagnie', 'adresse_compagnie', 'email_compagnie', 'contact_compagnie', 'postal_compagnie', 'code_compagnie');

            if ($foundHeaders !== $requiredHeaders) {
                echo 'Headers do not match: ' . implode(', ', $foundHeaders);
                return back()->with('success', 'Veuillez entrer la bonne base');
            } else {



                // $header = array_shift($rows);

                $file = $request->import_compagnie;



                // Open uploaded CSV file with read-only mode
                $csvFile  = fopen($file, "r");



                // Skip the first line
                fgetcsv($csvFile);

                // Parse data from CSV file line by line
                while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE) {

                    // dd($getData);

                    $pcreate_data[] =
                        array(
                            'nom_compagnie' => $getData[0],
                            'adresse_compagnie' => $getData[1],
                            'email_compagnie' => $getData[2],
                            'contact_compagnie' => $getData[3],
                            'postal_compagnie' => $getData[4],
                            'id_entreprise' =>  Auth::user()->id_entreprise,
                            'user_id' =>  Auth::user()->id,
                            'code_compagnie' => $getData[5],
                        );
                }



                foreach ($pcreate_data as $data) {
                    Compagnie::create($data);
                }


                return back()->with('success', 'Base de donnees compagnies importes');
            }
        }
    }

    public function importauxcompagnie(Request $request)
    {
        $request->validate([
            'import_tauxcompagnie' => ['file']
        ]);

        if (!empty($request->import_tauxcompagnie)) {
            $file = $request->import_tauxcompagnie;
            $rows  = array_map("str_getcsv", file($file, FILE_SKIP_EMPTY_LINES));
            $header = array_shift($rows);
            $f = fopen($file, "r");
            $firstLine = fgets($f); //get first line of csv file
            fclose($f); // close file
            $foundHeaders = str_getcsv(trim($firstLine), ',', '"'); //parse to array

            $requiredHeaders = array('code_compagnie', 'nom_branche', 'taux',);

            if ($foundHeaders !== $requiredHeaders) {
                echo 'Headers do not match: ' . implode(', ', $foundHeaders);
                return back()->with('success', 'Veuillez entrer la bonne base');
            } else {


                // Parse data from CSV file line by line
                $filePath = $request->import_tauxcompagnie;
                $file = fopen($filePath, 'r');

                $header = fgetcsv($file);

                $tauxcompagnies = [];
                while ($row = fgetcsv($file)) {
                    $tauxcompagnies[] = array_combine($header, $row);
                }

                fclose($file);

                return view('parametre.upload', compact('tauxcompagnies'));
            }
        }
    }

    public function validatetauxcompagnie(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();


            foreach ($data['attrId'] as $key => $attr) {
                if (!empty($attr)) {
                    TauxCompagnie::create(['id_compagnie' => $data['id_compagnie'][$key], 'id_branche' => $data['id_branche'][$key], 'tauxcomp' => $data['taux'][$key]]);
                }
            }

            return view('parametre.upload')->with('success', 'Base de donnees taux compagnies importes');
        }
    }

    public function importcontrat(Request $request)
    {
        $request->validate([
            'import_contrat' => ['file']
        ]);

        // if (!empty($request->import_contrat)) {
        //     $file = $request->import_contrat;
        //     $rows  = array_map("str_getcsv", file($file, FILE_SKIP_EMPTY_LINES));
        //     $header = array_shift($rows);
        //     $f = fopen($file, "r");
        //     $firstLine = fgets($f); //get first line of csv file
        //     fclose($f); // close file
        //     $foundHeaders = str_getcsv(trim($firstLine), ',', '"'); //parse to array

        //     $requiredHeaders = array('nom_branche', 'nom_client', 'nom_compagnie', 'nom_apporteur', 'n_police ', 'souscrit_le', 'effet_police', 'heure_police', 'expire_le', 'reconduction', 'prime_nette', 'frais_courtier', ' accessoire', 'cfga', ' taxes_totales', 'prime_ttc', 'commission_courtier', 'gestion', 'commision_apporteur', 'solde', 'reverse');

        //     if ($foundHeaders !== $requiredHeaders) {
        //         echo 'Headers do not match: ' . implode(', ', $foundHeaders);
        //         return back()->with('success', 'Veuillez entrer la bonne base');
        //     } else {


        $filePath = $request->import_contrat;
        $file = fopen($filePath, 'r');

        $header = fgetcsv($file);

        $users = [];
        while ($row = fgetcsv($file)) {
            $users[] = array_combine($header, $row);
        }

        fclose($file);

        return view('parametre.upload', compact('users'));
        // }
        // }
    }

    public function validatecontrat(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            // Insertion des contrats

            foreach ($data['attrId'] as $key => $attr) {
                if (!empty($attr)) {
                    Contrat::create(
                        [
                            'id_branche' => $data['branche'][$key], 'id_client' => $data['client'][$key], 'id_compagnie' => $data['compagnie'][$key],
                            'id_apporteur' => $data['apporteur'][$key], 'numero_police' => $data['police'][$key], 'souscrit_le' => $data['souscrit'][$key],
                            'effet_police' => $data['effet'][$key], 'heure_police' => $data['heure'][$key], 'expire_le' => $data['expire'][$key],
                            'reconduction' => $data['reconduction'][$key], 'prime_nette' => $data['prime'][$key], 'frais_courtier' => $data['frais'][$key],
                            'accessoires' => $data['accessoires'][$key], 'cfga' => $data['cfga'][$key], 'taxes_totales' => $data['taxes'][$key],
                            'primes_ttc' => $data['prime_ttc'][$key], 'commission_courtier' => $data['commission'][$key], 'gestion' => $data['gestion'][$key],
                            'solde' => $data['solde'][$key], 'reverse' => $data['reverse'][$key], 'id_entreprise' => $data['entreprise'][$key], 'user_id' => $data['user'][$key]
                        ]
                    );
                }
            }

            // Insertion des avenants

            // foreach ($data['attrId'] as $key => $attr) {
            //     if (!empty($attr)) {
            //         Avenant::create(
            //             [
            //                 'id_branche' => $data['branche'][$key], 'id_client' => $data['client'][$key], 'id_compagnie' => $data['compagnie'][$key],
            //                 'id_apporteur' => $data['apporteur'][$key], 'numero_police' => $data['police'][$key], 'souscrit_le' => $data['souscrit'][$key],
            //                 'effet_police' => $data['effet'][$key], 'heure_police' => $data['heure'][$key], 'expire_le' => $data['expire'][$key],
            //                 'reconduction' => $data['reconduction'][$key], 'prime_nette' => $data['prime'][$key], 'frais_courtier' => $data['frais'][$key],
            //                 'accessoires' => $data['accessoires'][$key], 'cfga' => $data['cfga'][$key], 'taxes_totales' => $data['taxes'][$key],
            //                 'primes_ttc' => $data['prime_ttc'][$key], 'commission_courtier' => $data['commission'][$key], 'gestion' => $data['gestion'][$key],
            //                 'solde' => $data['solde'][$key], 'reverse' => $data['reverse'][$key], 'id_entreprise' => $data['entreprise'][$key], 'user_id' => $data['user'][$key]
            //             ]
            //         );
            //     }
            // }


            return view('parametre.upload')->with('success', 'Base de donnees contrats importes');;
        }
    }

    public function importsinistre(Request $request)
    {
        $request->validate([
            'import_sinistre' => ['file']
        ]);

        // if (!empty($request->import_sinistre)) {
        //     $file = $request->import_sinistre;
        //     $rows  = array_map("str_getcsv", file($file, FILE_SKIP_EMPTY_LINES));
        //     $header = array_shift($rows);
        //     $f = fopen($file, "r");
        //     $firstLine = fgets($f); //get first line of csv file
        //     fclose($f); // close file
        //     $foundHeaders = str_getcsv(trim($firstLine), ',', '"'); //parse to array

        //     $requiredHeaders = array('numero_police', 'date_survenance', 'heure', 'date_declaration', 'date_ouverture ', 'date_decla_compagnie', 'numero_sinistre', 'reference_compagnie', 'gestion_compagnie', 'materiel_sinistre', 'ipp', 'garantie_applique', ' recours_sinistre', 'date_mission', ' accident_sinistre', 'lieu_sinistre', 'expert', 'commentaire_sinistre');

        //     if ($foundHeaders !== $requiredHeaders) {
        //         echo 'Headers do not match: ' . implode(', ', $foundHeaders);
        //         return back()->with('success', 'Veuillez entrer la bonne base');
        //     } else {
        $filePath = $request->import_sinistre;
        $file = fopen($filePath, 'r');

        $header = fgetcsv($file);

        $sinistres = [];
        while ($row = fgetcsv($file)) {
            $sinistres[] = array_combine($header, $row);
        }

        fclose($file);

        return view('parametre.upload', compact('sinistres'));
        // }
        // }
    }

    public function validatesinistre(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();


            foreach ($data['attrId'] as $key => $attr) {
                if (!empty($attr)) {
                    Sinistre::create([
                        'id_contrat' => $data['id_contrat'][$key], 'date_survenance' => $data['date_survenance'][$key],
                        'heure' => $data['heure'][$key], 'date_declaration' => $data['date_declaration'][$key],
                        'date_ouverture' => $data['date_ouverture'][$key], 'date_decla_compagnie' => $data['date_decla_compagnie'][$key],
                        'numero_sinistre' => $data['numero_sinistre'][$key], 'reference_compagnie' => $data['reference_compagnie'][$key],
                        'gestion_compagnie' => $data['gestion_compagnie'][$key], 'materiel_sinistre' => $data['materiel_sinistre'][$key],
                        'ipp' => $data['ipp'][$key], 'garantie_applique' => $data['garantie_applique'][$key],
                        'date_mission' => $data['date_mission'][$key], 'accident_sinistre' => $data['accident_sinistre'][$key],
                        'lieu_sinistre' => $data['lieu_sinistre'][$key], 'expert' => $data['expert'][$key],
                        'commentaire_sinistre' => $data['commentaire_sinistre'][$key], 'id_entreprise' => $data['entreprise'][$key], 'user_id' => $data['user'][$key],
                    ]);
                }
            }

            return view('parametre.upload')->with('success', 'Base de donnees sinistre importes');
        }
    }
}
