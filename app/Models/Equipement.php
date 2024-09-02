<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'marque', 'model', 'numeroSerie', 'dateAchat',
        'codeQr', 'localisation', 'garantieExp', 'prix', 'stock',
        'gestionnaire_id', 'magasin_id', 'fournisseur_id'
    ];

    public function gestionnaire()
    {
        return $this->belongsTo(Gestionnaire::class);
    }

    public function magasin()
    {
        return $this->belongsTo(Magasin::class);
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

}
