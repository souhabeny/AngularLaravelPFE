<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categorie;
use App\User;
use App\Commande;
use App\Like;
use App\Devis;
use App\Couleur;
class Produit extends Model
{
   
    public function categorie()
    {
        return $this->belongTo(Categorie::class);
    }
    public function user()
    {
        return $this->belongTo(User::class);
    }
    public function commande()
    {
        return $this->belongsToMany(Commande::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function devis()
    {
        return $this->belongTo(Devis::class);
    }
    protected $casts = [
        'couleur' => 'array'
    ];
    protected $fillable = [ 'libelle', 'description','image','prix','promo','couleur','idCategorie','idUser'];
}
