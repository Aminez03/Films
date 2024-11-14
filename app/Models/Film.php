<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'rating',
        'date',
        'description',
        'trailer',
        'categorieID'
    ];
    public function categories()
    {
    return $this->belongsTo(Categorie::class,"categorieID");
    }
}
