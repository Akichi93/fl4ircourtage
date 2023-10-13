<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_prospect';

    protected $fillable = [
        'civilite',
        'nom_prospect',
        'prenom_prospect',
        'postal_prospect',
        'adresse_prospect',
        'tel_prospect',
        'profession_prospect',
        'fax_prospect',
        'email_prospect',
        'id_entreprise',
        'user_id',
    ];
}
