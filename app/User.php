<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Produit;
use App\Gouvernerat;
use App\Commande;
use App\Message;
use App\Like;
use App\Devis;
class User extends Authenticatable implements JWTSubject
{
    public function produits(){
        return $this->hasMany(Produit::class);
    }

    public function commande()
    {
        return $this->belongTo(Commande::class);
    }
    public function gouvernerat()
    {
        return $this->belongTo(Gouvernerat::class);
    }
    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function devis()
    {
        return $this->hasMany(Devis::class);
    }
    use Notifiable;

    protected $fillable = [ 'nom', 'prenom','adresse','datenaiss','idGouvernerat','role','domaine','codePostal','tel','email','password','image'];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    /*protected $hidden = [
        'password', 'remember_token',
    ];
*/
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    
   public function setPasswordAttribute($value)
    {
      $this->attributes['password'] = bcrypt($value);
    }
    
}
