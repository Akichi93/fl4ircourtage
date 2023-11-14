<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_contrat';

    protected $fillable = [
        'id_branche',
        'id_client',
        'id_compagnie',
        'id_apporteur',
        'numero_police',
        'souscrit_le',
        'effet_police',
        'heure_police',
        'expire_le',
        'reconduction',
        'prime_nette',
        'frais_courtier',
        'accessoires',
        'cfga',
        'taxes_totales',
        'commission_courtier',
        'commission_apporteur',
        'gestion',
        'solde',
        'reverse',
        'id_entreprise',
        'user_id',
        'prime_ttc',
        'commission_apporteur',
        'commission_courtier',
    ];

    protected $casts = [
        'souscrit_le' => 'datetime:d/m/Y',
        'expire_le' => 'datetime:d/m/Y',
    ];

    public function automobiles() {
        return $this->belongsToMany(Automobile::class,'automobile_contrats', 'id_automobile','id_contrat');
    }

    public function branches() {
        return $this->belongsTo(Branche::class);
    }

    public function clients() {
        return $this->belongsTo(Client::class);
    }

    public function compagnies() {
        return $this->belongsTo(Compagnie::class);
    }

    public function apporteurs() {
        return $this->belongsTo(Apporteur::class);
    }
}
