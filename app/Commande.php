<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Produit;
class Commande extends Model
{
    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function produit()
    {
        return $this->belongsToMany(Produit::class);
    }

    protected $fillable = [ 'date', 'iduser'];

}
