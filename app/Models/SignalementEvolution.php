<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignalementEvolution extends Model
{
    protected $fillable = [
        'signalement_id',
        'image_path',
        'description',
        'pourcentage_avancement',
    ];

    public function signalement()
    {
        return $this->belongsTo(Signalement::class);
    }
}
