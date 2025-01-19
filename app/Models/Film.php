<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'rating', 'date', 'description', 'trailer', 'categorieID'
    ];

    // Relation vers le modèle Categorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorieID');
    }
}
