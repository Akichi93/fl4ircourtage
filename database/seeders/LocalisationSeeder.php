<?php

namespace Database\Seeders;

use App\Models\Localisation;
use Illuminate\Database\Seeder;

class LocalisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $VilleRecords = [
            ['id_localisation' => '1', 'nom_ville' => 'Abidjan', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '2', 'nom_ville' => 'Yamoussoukro', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '3', 'nom_ville' => 'Bouaké', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '4', 'nom_ville' => 'Daloa', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '5', 'nom_ville' => 'Korhogo', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '6', 'nom_ville' => 'San Pedro', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '7', 'nom_ville' => 'Man', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '8', 'nom_ville' => 'Abengourou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '9', 'nom_ville' => 'Divo', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '10', 'nom_ville' => 'Gagnoa', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '11', 'nom_ville' => 'Bondoukou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '12', 'nom_ville' => 'Séguéla', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '13', 'nom_ville' => 'Odienné', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '14', 'nom_ville' => 'Dimbokro', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '15', 'nom_ville' => 'Ferkessédougou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '16', 'nom_ville' => 'Agboville', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '17', 'nom_ville' => 'Bingerville', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '18', 'nom_ville' => 'Sinfra', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '19', 'nom_ville' => 'Soubré', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '20', 'nom_ville' => 'Katiola', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '21', 'nom_ville' => 'Bouaflé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '22', 'nom_ville' => 'Sakassou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '23', 'nom_ville' => 'Grand-Bassam', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '24', 'nom_ville' => 'Sassandra', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '25', 'nom_ville' => 'Dabou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '26', 'nom_ville' => 'Toumodi', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '27', 'nom_ville' => 'Bouna', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '28', 'nom_ville' => 'Agnibilékrou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '29', 'nom_ville' => 'Guiglo', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '30', 'nom_ville' => 'Danané', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '31', 'nom_ville' => 'Soubre', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '32', 'nom_ville' => 'Tabou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '33', 'nom_ville' => 'Touba', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '34', 'nom_ville' => 'Zuénoula', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '35', 'nom_ville' => 'Adzopé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '36', 'nom_ville' => 'Aboisso', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '37', 'nom_ville' => 'Tiassalé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '38', 'nom_ville' => 'Bongouanou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '39', 'nom_ville' => 'Akoupé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '40', 'nom_ville' => 'Korhogo', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '41', 'nom_ville' => 'Boundiali', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '42', 'nom_ville' => 'Ferkéssédougou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '43', 'nom_ville' => 'Katiola', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '44', 'nom_ville' => 'Koun-Fao', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '45', 'nom_ville' => 'Niakaramandougou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '46', 'nom_ville' => 'Korhogo', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '47', 'nom_ville' => 'Mankono', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '48', 'nom_ville' => 'Séguéla', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '49', 'nom_ville' => 'Odienne', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '50', 'nom_ville' => 'Gonfreville', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '51', 'nom_ville' => 'Agnéby', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '52', 'nom_ville' => 'Oumé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '53', 'nom_ville' => 'Bouaflé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '54', 'nom_ville' => 'Sinfra', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '55', 'nom_ville' => 'Zuénoula', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '56', 'nom_ville' => 'Bouaké', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '57', 'nom_ville' => 'Botro', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '58', 'nom_ville' => 'Dimbokro', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '59', 'nom_ville' => 'Daoukro', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '60', 'nom_ville' => 'Divo', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '61', 'nom_ville' => 'Lakota', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '62', 'nom_ville' => 'Gagnoa', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '63', 'nom_ville' => 'Issia', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '64', 'nom_ville' => 'Vavoua', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '65', 'nom_ville' => 'Duékoué', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '66', 'nom_ville' => 'Bangolo', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '67', 'nom_ville' => 'Biankouma', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '68', 'nom_ville' => 'Man', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '69', 'nom_ville' => 'Danané', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '70', 'nom_ville' => 'Guiglo', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '71', 'nom_ville' => 'Touba', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '72', 'nom_ville' => 'Bin-Houyé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '73', 'nom_ville' => 'Korhogo', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '74', 'nom_ville' => 'Katiola', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '75', 'nom_ville' => 'Ferkessédougou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '76', 'nom_ville' => 'Bouna', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '77', 'nom_ville' => 'Téhini', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '78', 'nom_ville' => 'Bondoukou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '79', 'nom_ville' => 'Koun-Fao', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '80', 'nom_ville' => 'Adiaké', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '81', 'nom_ville' => 'Aboisso', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '82', 'nom_ville' => 'Grand-Lahou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '83', 'nom_ville' => 'Dabou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '84', 'nom_ville' => 'Sassandra', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '85', 'nom_ville' => 'San Pedro', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '86', 'nom_ville' => 'Tabou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '87', 'nom_ville' => 'Divo', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '88', 'nom_ville' => 'Sikensi', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '89', 'nom_ville' => 'Adzopé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '90', 'nom_ville' => 'Tiassalé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '91', 'nom_ville' => 'Taabo', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '92', 'nom_ville' => 'Sinfra', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '93', 'nom_ville' => 'Daoukro', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '94', 'nom_ville' => 'Toumodi', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '95', 'nom_ville' => 'Bouaflé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '96', 'nom_ville' => 'Gohitafla', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '97', 'nom_ville' => 'Daloa', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '98', 'nom_ville' => 'Issia', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '99', 'nom_ville' => 'Zouan-Hounien', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '100', 'nom_ville' => 'Soubré', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '101', 'nom_ville' => 'Soubre', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '102', 'nom_ville' => 'Oumé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '103', 'nom_ville' => 'Guitry', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '104', 'nom_ville' => 'Facobly', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '105', 'nom_ville' => 'Danané', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '106', 'nom_ville' => 'Toulépleu', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '107', 'nom_ville' => 'Duékoué', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '108', 'nom_ville' => 'Biankouma', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '109', 'nom_ville' => 'Fronan', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '110', 'nom_ville' => 'Bingerville', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '111', 'nom_ville' => 'Adiaké', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '112', 'nom_ville' => 'Adzopé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '113', 'nom_ville' => 'Tiassalé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '114', 'nom_ville' => 'Taabo', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '115', 'nom_ville' => 'Sikensi', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '116', 'nom_ville' => 'Grand-Lahou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '117', 'nom_ville' => 'Aboisso', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '118', 'nom_ville' => 'Alépé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '119', 'nom_ville' => 'Dabou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '120', 'nom_ville' => 'Jacqueville', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '121', 'nom_ville' => 'Songon', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '122', 'nom_ville' => 'Bingerville', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '123', 'nom_ville' => 'Azaguie', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '124', 'nom_ville' => 'N\'Douci', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '125', 'nom_ville' => 'Bongouanou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '126', 'nom_ville' => 'Andé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '127', 'nom_ville' => 'M\'Bahiakro', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '128', 'nom_ville' => 'M\'Batto', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '129', 'nom_ville' => 'N\'zi-Comoé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '130', 'nom_ville' => 'Tiébissou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '131', 'nom_ville' => 'M\'Bengue', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '132', 'nom_ville' => 'Sakassou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '133', 'nom_ville' => 'Bouaflé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '134', 'nom_ville' => 'Daloa', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '135', 'nom_ville' => 'Issia', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '136', 'nom_ville' => 'Vavoua', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '137', 'nom_ville' => 'Zoukougbeu', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '138', 'nom_ville' => 'Gohitafla', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '139', 'nom_ville' => 'Toumodi', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '140', 'nom_ville' => 'N\'Douci', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '141', 'nom_ville' => 'Agboville', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '142', 'nom_ville' => 'Sikensi', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '143', 'nom_ville' => 'Adzopé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '144', 'nom_ville' => 'Tiassalé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '145', 'nom_ville' => 'Taabo', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '146', 'nom_ville' => 'M\'Pouya', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '147', 'nom_ville' => 'Dabou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '148', 'nom_ville' => 'Jacqueville', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '149', 'nom_ville' => 'Grand-Lahou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '150', 'nom_ville' => 'Sassandra', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '151', 'nom_ville' => 'San Pedro', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '152', 'nom_ville' => 'Tabou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '153', 'nom_ville' => 'Soubré', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '154', 'nom_ville' => 'Gagnoa', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '155', 'nom_ville' => 'Issia', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '156', 'nom_ville' => 'Vavoua', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '157', 'nom_ville' => 'Duékoué', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '158', 'nom_ville' => 'Bangolo', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '159', 'nom_ville' => 'Biankouma', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '160', 'nom_ville' => 'Man', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '161', 'nom_ville' => 'Danané', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '162', 'nom_ville' => 'Guiglo', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '163', 'nom_ville' => 'Touba', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '164', 'nom_ville' => 'Korhogo', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '165', 'nom_ville' => 'Bouna', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '166', 'nom_ville' => 'Téhini', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '167', 'nom_ville' => 'Bondoukou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '168', 'nom_ville' => 'Koun-Fao', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '169', 'nom_ville' => 'Adiaké', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '170', 'nom_ville' => 'Aboisso', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '171', 'nom_ville' => 'Tingréla', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '172', 'nom_ville' => 'Odienné', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '173', 'nom_ville' => 'Madinani', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '174', 'nom_ville' => 'Korhogo', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '175', 'nom_ville' => 'Ferkessédougou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '176', 'nom_ville' => 'Katiola', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '177', 'nom_ville' => 'Bouna', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '178', 'nom_ville' => 'Téhini', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '179', 'nom_ville' => 'Bondoukou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '180', 'nom_ville' => 'Koun-Fao', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '181', 'nom_ville' => 'Adiaké', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '182', 'nom_ville' => 'Aboisso', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '183', 'nom_ville' => 'Tingréla', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '184', 'nom_ville' => 'Tanda', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '185', 'nom_ville' => 'Dabakala', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '186', 'nom_ville' => 'Prikro', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '187', 'nom_ville' => 'Koun-Fao', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '188', 'nom_ville' => 'Agnibilékrou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '189', 'nom_ville' => 'Tiébissou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '190', 'nom_ville' => 'M\'Batto', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '191', 'nom_ville' => 'Djékanou', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '192', 'nom_ville' => 'Ettrokro', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '193', 'nom_ville' => 'Abongoua', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '194', 'nom_ville' => 'Ouellé', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '195', 'nom_ville' => 'Kouassi-N\'Dawa', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_localisation' => '196', 'nom_ville' => 'M\'batto', 'created_at' => NULL, 'updated_at' => NULL],
        ];

        Localisation::insert($VilleRecords);
    }
}