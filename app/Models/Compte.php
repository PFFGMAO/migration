<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;

    protected $fillable = [
        'login',
        'password',
    ];

    public function personne()
    {
        return $this->belongsTo(User::class);
    }

}
