<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Produit;
class Categorie extends Model
{
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
    protected $fillable = ['nomcategorie'];
}

