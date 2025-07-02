<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = [
        'libelle',
        'description',
    ];

    public function signalements()
    {
        return $this->hasMany(Signalement::class);
    }
}
