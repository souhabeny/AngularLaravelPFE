<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Produit;
class Devis extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
    protected $casts = [
        'couleurSouhaite' => 'array',
        'qtecouleur' => 'array'
    ];
    protected $fillable = ['prixpropose','qte','idUser','idProduit','reponse','couleurSouhaite','qtecouleur'];
}