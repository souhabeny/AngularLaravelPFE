<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Produit;
class Like extends Model
{
    protected $fillable = ['user_id','produit_id','like'];
    public function user()
    {
        return $this->belongTo(User::class);
    }
    public function produit()
    {
        return $this->belongTo(Produit::class);
    }
}
