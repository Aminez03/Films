<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable=["nomCategorie","description "];
    
    public function Films()
    {
    return $this->hasMany(Film::class ,"categorieID");
    }
}
