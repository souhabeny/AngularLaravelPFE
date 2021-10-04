<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\commanderequest;
use App\Http\Requests\Lignecommanderequest;
use App\Commande;
use App\LigneCommande;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use \App\Mail\MailCommandeArtisan;
use \App\Mail\sendmailclient;
use Carbon\Carbon;

class CommandeController extends Controller
{   public $tab = [];
    public function __construct()
    {
         
    }
    
    public function addCommande(commanderequest $request)
    {  
        $commande = Commande::create($request->all());
        return $commande;
    } 
    public function addligneCommande(Lignecommanderequest $request)
    {  
     
        $LigneCommande = LigneCommande::create($request->all());
        $details = DB::table('produits')
        ->where('produits.id', '=', $LigneCommande->idProduit)
        ->get();
      
        return $LigneCommande;
    } 
    public function getProduitCommandClient($id)
    {
      $produits = DB::table('produits')
      ->select('produits.libelle','produits.image','commandes.date','produits.prix','ligne_commandes.qtecommande','users.nom','users.prenom','users.email','users.tel','produits.promo')
      ->join('ligne_commandes', 'ligne_commandes.idProduit','=','produits.id')
      ->join('users', 'users.id','=','produits.idUser')
      ->join('commandes', 'commandes.id', '=', 'ligne_commandes.idCommande')
      ->orderBy('commandes.date','DESC')
      ->where('commandes.idUser','=',$id)
      ->get();
      return $produits;
    }
    public function getProduitCommandArtisan($id)
    {
        $produits = DB::table('produits')
        ->select('produits.libelle','produits.image','commandes.date','produits.prix','ligne_commandes.qtecommande','users.nom','users.prenom','produits.promo')
        ->join('ligne_commandes', 'ligne_commandes.idProduit','=','produits.id')   
        ->join('commandes', 'commandes.id', '=', 'ligne_commandes.idCommande')
        ->join('users', 'users.id','=','commandes.iduser')
        ->orderBy('commandes.date','DESC')
        ->where('produits.idUser','=',$id)
        ->get();
        return $produits;
    }
    public function lastcommades($id){
        $now = Carbon::now()->subDays(10);
        $expires = $now->toDateString();
        $produits = DB::table('produits')
        ->select('commandes.id','produits.libelle','produits.image','commandes.date','produits.prix','ligne_commandes.qtecommande','produits.promo')
        ->join('ligne_commandes', 'ligne_commandes.idProduit','=','produits.id')
        //->join('users', 'users.id','=','produits.idUser')
        ->join('commandes', 'commandes.id', '=', 'ligne_commandes.idCommande')
        ->orderBy('commandes.date','DESC')
        ->where('commandes.idUser','=',$id)
        ->whereDate('commandes.date','>=',$expires)
        ->get();
        return $produits;
  }
    public function emailClient(Request  $r)
    {
      $iduser = DB::table('commandes')
      ->where('commandes.id', '=', $r->id)
      ->pluck('iduser');

      $email = DB::table('users')
      ->where('id', '=', $iduser)
      ->get('email');
      
      \Mail::to($email)->send(new sendmailclient($r->produit));
      return  $r->produit;
    }
   
    public function emailArtisan(Request  $r)
    { 
 
        $iduser = DB::table('users')
        ->join('produits', 'produits.idUser', '=', 'users.id')
        ->join('ligne_commandes', 'ligne_commandes.idProduit', '=', 'produits.id')
        ->where('ligne_commandes.idCommande','=', $r->id)
        ->distinct()
        ->pluck('users.id')
        ->toArray();
        
       for($i = 0;$i<count($iduser);$i++)
      { $details = DB::table('produits')
        ->join('ligne_commandes', 'ligne_commandes.idProduit', '=', 'produits.id')
        ->where('ligne_commandes.idCommande','=',$r->id)
        ->where('produits.idUser', '=', $iduser[$i])
        ->get();
        $email[$i] = DB::table('users')
        ->join('produits', 'produits.idUser', '=', 'users.id') 
        ->join('ligne_commandes', 'ligne_commandes.idProduit', '=', 'produits.id')
        ->where('ligne_commandes.idCommande','=',$r->id)
        ->where('produits.idUser', '=', $iduser[$i])
        ->distinct()
        ->get('email');
        \Mail::to($email[$i])->send(new MailCommandeArtisan($details,$r->produit));  
      }
      
        
        return $details;
    }
    public function nbcommandeArtisan($id)
    {
        $nbcmdArtisan =DB::table('produits')
        ->join('ligne_commandes', 'produits.id', '=', 'ligne_commandes.idProduit')
        ->where('produits.idUser','=',$id)
        ->count();
    
      return $nbcmdArtisan;
    }
    public function nbAchatClient($id)
    { 
      $nbcmdclient =DB::table('commandes')
      ->where('idUser','=',$id)
      ->get()
      ->count();
      return $nbcmdclient;
    }
    public function getcommandByUser($id)
    {
      $cmd= DB::table('commandes')
      ->where('iduser','=',$id)
      ->orderBy('commandes.created_at', 'DESC')
      ->get();
      return $cmd;
    }
    public function getlignecommandByCommand($idc)
    {
      $cmd= DB::table('produits')
      ->join('ligne_commandes', 'ligne_commandes.idProduit', '=', 'produits.id')
      ->where('ligne_commandes.idCommande','=',$idc)
      ->get();
      return $cmd;
    }
}
