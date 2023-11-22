<?php

namespace Database\Seeders;

use App\Models\Branche;
use Illuminate\Database\Seeder;

class BrancheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brancheRecords = [
            ['id_branche' => 1, 'nom_branche' => 'AUTOMOBILE', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 2, 'nom_branche' => 'MOTO', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 3, 'nom_branche' => 'RC DIVERSES', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 4, 'nom_branche' => 'RC EXPLOITATION', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 5, 'nom_branche' => 'RC ENTREPRISE', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 6, 'nom_branche' => 'RC ASSOCIATION SPORTIVE', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 7, 'nom_branche' => 'RC PROFESSIONNELLE', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 8, 'nom_branche' => 'TRANSPORT', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 9, 'nom_branche' => 'RC PLAISANCE', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 10, 'nom_branche' => 'MULTIRISQUE PLAISANCE', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 11, 'nom_branche' => 'MARCHANDISES TRANSPORTEES', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 12, 'nom_branche' => 'CORPS FLUVIAUX', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 13, 'nom_branche' => 'MALADIE GROUPE', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 14, 'nom_branche' => 'MALADIE PARTICULIER', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 15, 'nom_branche' => 'ASSISTANCE', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 16, 'nom_branche' => 'TOUS RISQUES SAUF', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 17, 'nom_branche' => 'GLOBALES DOMMAGES', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 18, 'nom_branche' => 'MULTIRISQUE IMMEUBLE', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 19, 'nom_branche' => 'MULTIRISQUE HABITATION', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 20, 'nom_branche' => 'MULTIRISQUE PROFESSIONELLE', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 21, 'nom_branche' => 'MULTIRISQUE BUREAUX', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 22, 'nom_branche' => 'TOUS RISQUE CHANTIER', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 23, 'nom_branche' => 'RC DECENNALE', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 24, 'nom_branche' => 'TOUS RISQUE MATERIELS', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 25, 'nom_branche' => 'ENGINS DE CHANTIERS', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 26, 'nom_branche' => 'BRIS DE MACHINES', 'id_entreprise' => '1', 'created_at' => NULL, 'updated_at' => NULL],
        ];

    

        Branche::insert($brancheRecords);
    }
}
