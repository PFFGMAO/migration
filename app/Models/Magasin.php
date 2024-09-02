<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magasin extends Model
{
    use HasFactory;

        protected $fillable = [
        'adresse', 'nom', 'capaciter',
    ];

    public function equipements()
    {
        return $this->hasMany(Equipement::class);
    }

}
