<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;

class Signalement extends Model
{
    use HasStatuses;
    
    protected $fillable = [
        'user_id',
        'titre',
        'description',
        'image_path',
        'latitude',
        'longitude',
        'category_id',
        'vues',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function evolutions()
    {
        return $this->hasMany(SignalementEvolution::class);
    }
}
