<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Branche;
use App\Models\Prospect;
use App\Models\Sinistre;
use App\Models\Apporteur;
use Illuminate\Http\Request;
use App\Models\TauxApporteur;
use App\Models\TauxCompagnie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UploadController extends Controller
{
    public function importclient(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'import_client' => 'required|file|mimes:csv,txt',
        ]);


        $user = JWTAuth::parseToken()->authenticate();

        $entreprise = $user->id_entreprise;

        $id = $user->id;

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $file = $request->file('import_client');

        // Check if the file is empty
        if ($file->getSize() === 0) {
            return response()->json(['error' => 'Le fichier CSV est vide.'], 422);
        }

        // Define expected data types for each column
        $expectedTypes = [
            'civilite' => 'string',
            'nom_client' => 'string',
            'postal_client' => 'string',
            'adresse_client' => 'string',
            'tel_client' => 'string',
            'profession_client' => 'string',
            'fax_client' => 'string',
            'email_client' => 'email',
            'numero_client' => 'string',
        ];

        // Process CSV data in batches
        $batchSize = 1000; // Nombre de lignes par lot

        $csvFile = fopen($file->getPathname(), 'r');
        $header = fgetcsv($csvFile); // Get the header

        // Validate the headers
        $validator = $this->validateHeaders($header, array_keys($expectedTypes));
        if ($validator->fails()) {
            fclose($csvFile);
            return response()->json(['error' => 'Les en-têtes ne correspondent pas : ' . $validator->errors()->first()], 422);
        }

        $pcreate_data = [];
        $processedRows = [];
        $duplicateRows = [];

        while (($getData = fgetcsv($csvFile, 10000, ",")) !== false) {
            // Check for duplicate rows
            $hash = md5(implode(',', $getData));
            if (in_array($hash, $processedRows)) {
                $duplicateRows[] = $getData;
            } else {
                $processedRows[] = $hash;

                // Validate the data types of each column
                $validator = $this->validateDataTypes($getData, $expectedTypes);
                if ($validator->fails()) {
                    fclose($csvFile);
                    return response()->json(['error' => 'Type de données incorrect dans une colonne : ' . $validator->errors()->first()], 422);
                }

                $pcreate_data[] = array_combine($header, $getData) + [
                    'id_entreprise' => $entreprise,
                    'user_id' => $id,
                ];
            }

            // Si le lot est prêt ou si nous avons atteint la fin du fichier
            if (count($pcreate_data) >= $batchSize || feof($csvFile)) {
                // Insérer le lot dans la base de données
                $this->insertBatchData($pcreate_data);

                // Réinitialiser le tableau pour le prochain lot
                $pcreate_data = [];
            }
        }

        fclose($csvFile);

        if (!empty($duplicateRows)) {
            return response()->json(['success' => 'Base de données clients importée avec succès, mais des doublons ont été détectés.', 'duplicates' => $duplicateRows], 200);
        }

        return response()->json(['success' => 'Base de données clients importée avec succès'], 200);
    }

    public function importprospect(Request $request)
    {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'import_prospect' => 'required|file|mimes:csv,txt',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $user = JWTAuth::parseToken()->authenticate();
        $entreprise = $user->id_entreprise;
        $id = $user->id;

        $file = $request->file('import_prospect');

        // Check if the file is empty
        if ($file->getSize() === 0) {
            return response()->json(['error' => 'Le fichier CSV est vide.'], 422);
        }

        // Define expected data types for each column
        $expectedTypes = [
            'civilite' => 'string',
            'nom_prospect' => 'string',
            'postal_prospect' => 'string',
            'adresse_prospect' => 'string',
            'tel_prospect' => 'string',
            'profession_prospect' => 'string',
            'fax_prospect' => 'string',
            'email_prospect' => 'email',
        ];

        // Process CSV data in batches
        $batchSize = 1000; // Nombre de lignes par lot

        $csvFile = fopen($file->getPathname(), 'r');
        $header = fgetcsv($csvFile); // Get the header

        // Validate the headers
        $validator = $this->validateHeadersProspect($header, array_keys($expectedTypes));
        if ($validator->fails()) {
            fclose($csvFile);
            return response()->json(['error' => 'Les en-têtes ne correspondent pas : ' . $validator->errors()->first()], 422);
        }

        $pcreate_data = [];
        $processedEmails = [];
        $duplicateRows = [];

        while (($getData = fgetcsv($csvFile, 10000, ",")) !== false) {
            // Validate the data types of each column
            $validator = $this->validateDataTypesProspect($getData, $expectedTypes);
            if ($validator->fails()) {
                fclose($csvFile);
                return response()->json(['error' => 'Type de données incorrect dans une colonne : ' . $validator->errors()->first()], 422);
            }

            $email = $getData[array_search('email_prospect', $header)];

            // Check for duplicate emails
            if (in_array($email, $processedEmails)) {
                $duplicateRows[] = $getData;
            } else {
                $processedEmails[] = $email;

                $pcreate_data[] = array_combine($header, $getData) + [
                    'id_entreprise' => $entreprise,
                    'user_id' => $id,
                ];
            }

            // Si le lot est prêt ou si nous avons atteint la fin du fichier
            if (count($pcreate_data) >= $batchSize || feof($csvFile)) {
                // Insérer le lot dans la base de données
                $this->insertBatchDataProspect($pcreate_data);

                // Réinitialiser le tableau pour le prochain lot
                $pcreate_data = [];
            }
        }

        fclose($csvFile);

        if (!empty($duplicateRows)) {
            return response()->json(['success' => 'Base de données prospects importé avec succès, mais des doublons ont été détectés.', 'duplicates' => $duplicateRows], 200);
        }

        return response()->json(['success' => 'Base de données prospects importée avec succès'], 200);
    }

    public function importapporteur(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'import_apporteur' => 'required|file|mimes:csv,txt',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $user = JWTAuth::parseToken()->authenticate();
        $entreprise = $user->id_entreprise;
        $id = $user->id;

        $file = $request->file('import_apporteur');


        // Check if the file is empty
        if ($file->getSize() === 0) {
            return response()->json(['error' => 'Le fichier CSV est vide.'], 422);
        }

        // Define expected data types for each column
        $expectedTypes = [
            'nom_apporteur' => 'string',
            'email_apporteur' => 'email',
            'adresse_apporteur' => 'string',
            'contact_apporteur' => 'string',
            'code_apporteur' => 'string',
            'code_postal' => 'string',
        ];

        // Process CSV data in batches
        $batchSize = 1000; // Nombre de lignes par lot

        $csvFile = fopen($file->getPathname(), 'r');
        $header = fgetcsv($csvFile); // Get the header

        // Validate the headers
        $validator = $this->validateHeadersApporteur($header, array_keys($expectedTypes));
        if ($validator->fails()) {
            fclose($csvFile);
            return response()->json(['error' => 'Les en-têtes ne correspondent pas : ' . $validator->errors()->first()], 422);
        }

        $pcreate_data = [];
        $processedEmails = [];
        $duplicateRows = [];

        while (($getData = fgetcsv($csvFile, 10000, ",")) !== false) {
            // Validate the data types of each column
            $validator = $this->validateDataTypesApporteur($getData, $expectedTypes);
            if ($validator->fails()) {
                fclose($csvFile);
                return response()->json(['error' => 'Type de données incorrect dans une colonne : ' . $validator->errors()->first()], 422);
            }

            $email = $getData[array_search('email_apporteur', $header)];

            // Check for duplicate emails
            if (in_array($email, $processedEmails)) {
                $duplicateRows[] = $getData;
            } else {
                $processedEmails[] = $email;

                $pcreate_data[] = array_combine($header, $getData) + [
                    'id_entreprise' => $entreprise,
                    'user_id' => $id,
                ];
            }

            // Si le lot est prêt ou si nous avons atteint la fin du fichier
            if (count($pcreate_data) >= $batchSize || feof($csvFile)) {
                // Insérer le lot dans la base de données
                $this->insertBatchDataApporteur($pcreate_data);

                // Réinitialiser le tableau pour le prochain lot
                $pcreate_data = [];
            }
        }

        fclose($csvFile);

        if (!empty($duplicateRows)) {
            return response()->json(['success' => 'Base de données prospects importé avec succès, mais des doublons ont été détectés.', 'duplicates' => $duplicateRows], 200);
        }

        return response()->json(['success' => 'Base de données prospects importée avec succès'], 200);
    }

    public function importauxapporteur(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'import_tauxapporteur' => ['required', 'file', 'mimes:csv,txt', 'max:10240'] // Adjust max file size as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $file = $request->file('import_tauxapporteur');

        try {
            DB::beginTransaction();

            $header = $this->getCSVHeaderTauxApporteur($file);

            if (!$this->validateCSVHeaderTauxApporteur($header)) {
                throw new \Exception('Les en-têtes du fichier ne correspondent pas aux attentes.');
            }

            $tauxapporteur = $this->parseCSVDataTauxApporteur($file, $header);

            $this->processCSVDataTauxApporteur($tauxapporteur);

            DB::commit();
            return response()->json(['success' => true, 'data' => $tauxapporteur], 200);
        } catch (\Exception $e) {
            \Log::error('Error importing data: ' . $e->getMessage());
            DB::rollBack();
            return response()->json(['error' => 'Une erreur est survenue lors de l\'importation. Veuillez réessayer.'], 500);
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

    // Validation des entetes de l'importation clients
    private function validateHeaders($headers, $expectedHeaders)
    {
        return Validator::make($headers, [
            '*' => 'in:' . implode(',', $expectedHeaders),
        ]);
    }

    // Validation des types de données de la base clients
    private function validateDataTypes($data, $expectedTypes)
    {
        $rules = [];
        foreach ($expectedTypes as $column => $type) {
            $rules[$column] = $type;
        }

        return Validator::make($data, $rules);
    }

    // insertion dans la de données clients
    private function insertBatchData($batchData)
    {
        try {
            DB::beginTransaction();

            foreach ($batchData as $data) {
                Client::create($data);
            }
            \Log::info('Inserting batch dataclient: ' . json_encode($batchData));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error during client import: ' . $e->getMessage());
            // Gérer l'erreur si nécessaire
        }
    }

    private function validateHeadersProspect($headers, $expectedHeaders)
    {
        return Validator::make($headers, [
            '*' => 'in:' . implode(',', $expectedHeaders),
        ]);
    }

    private function validateDataTypesProspect($data, $expectedTypes)
    {
        $rules = [];
        foreach ($expectedTypes as $column => $type) {
            $rules[$column] = $type;
        }

        return Validator::make($data, $rules);
    }

    private function insertBatchDataProspect($batchDataProspect)
    {
        try {
            DB::beginTransaction();

            foreach ($batchDataProspect as $data) {
                // Check for existing prospect by email
                $existingProspect = Prospect::where('email_prospect', $data['email_prospect'])->first();

                if (!$existingProspect) {
                    Prospect::create($data);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error during prospect import: ' . $e->getMessage());
            // Gérer l'erreur si nécessaire
        }
    }

    private function validateHeadersApporteur($headers, $expectedHeaders)
    {
        return Validator::make($headers, [
            '*' => 'in:' . implode(',', $expectedHeaders),
        ]);
    }

    private function validateDataTypesApporteur($data, $expectedTypes)
    {
        $rules = [];
        foreach ($expectedTypes as $column => $type) {
            $rules[$column] = $type;
        }

        return Validator::make($data, $rules);
    }

    private function insertBatchDataApporteur($batchDataApporteur)
    {
        try {
            DB::beginTransaction();

            foreach ($batchDataApporteur as $data) {
                // Check for existing prospect by email
                $existingProspect = Apporteur::where('email_apporteur', $data['email_apporteur'])->first();

                if (!$existingProspect) {
                    Apporteur::create($data);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error during prospect import: ' . $e->getMessage());
            // Gérer l'erreur si nécessaire
        }
    }

    private function getCSVHeaderTauxApporteur($file)
    {
        $fileResource = fopen($file, 'r');
        $header = fgetcsv($fileResource);
        fclose($fileResource);

        return $header;
    }

    private function validateCSVHeaderTauxApporteur($header)
    {
        $requiredHeaders = ['code_apporteur', 'nom_branche', 'taux'];
        sort($header);
        sort($requiredHeaders);
        return array_map('strtolower', $header) == array_map('strtolower', $requiredHeaders);
    }

    private function parseCSVDataTauxApporteur($file, $header)
    {
        $tauxapporteur = [];
        $fileResource = fopen($file, 'r');

        while ($row = fgetcsv($fileResource)) {
            $tauxapporteur[] = array_combine($header, $row);
        }

        fclose($fileResource);
        return $tauxapporteur;
    }

    private function processCSVDataTauxApporteur($tauxapporteur)
    {
        // Remove the header
        $header = array_shift($tauxapporteur);

        // Initialize arrays to store values
        $apporteurIds = [];
        $brancheIds = [];
        $tauxValues = [];

        foreach ($tauxapporteur as $data) {
            $apporteur = Apporteur::where('code_apporteur', $data['code_apporteur'])->first();
            $branche = Branche::where('nom_branche', $data['nom_branche'])->first();

            if ($apporteur && $branche) {
                // Assign directly to the array using references
                $apporteurIds[] = $apporteur->id_apporteur;
                $brancheIds[] = $branche->id_branche;

                // Store the 'taux' value in the array
                $tauxValues[] = $data['taux'];
            } else {
                \Log::error('Correspondance d\'apporteur ou de branche non trouvée. Code apporteur : ' . $data['code_apporteur'] . ', Nom branche : ' . $data['nom_branche']);
                throw new \Exception('Correspondance d\'apporteur ou de branche non trouvée. Code apporteur : ' . $data['code_apporteur'] . ', Nom branche : ' . $data['nom_branche']);
            }

            $tauxValues[] = $data['taux'];
        }

        // Stockage des données dans la base de données
        foreach ($tauxapporteur as $key => $data) {
            try {
                // Use individual values, not arrays
                TauxApporteur::create([
                    'id_apporteur' => $apporteurIds[$key] ?? null,
                    'id_branche' => $brancheIds[$key] ?? null,
                    'taux' => $tauxValues[$key] ?? null,
                ]);
                
            } catch (\Exception $e) {
                \Log::error('Error inserting data into taux_apporteurs: ' . $e->getMessage());
                \Log::error('Failed data: ' . json_encode($data));
            }
        }
    }
}
