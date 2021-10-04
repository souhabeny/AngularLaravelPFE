<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Message extends Model
{ protected $fillable = ['idClient','idArtisan','message'];
    public function user(){
        return $this->belongTo(User::class);
    }
}
