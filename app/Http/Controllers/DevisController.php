<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Devis;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DevisRequest;
use Illuminate\Support\Facades\DB;
use \App\Mail\devisClient;
use \App\Mail\devisArtisan;
class DevisController extends Controller
{
    public function __construct()
    {
    }
    public function sendDevis(Request $request)
    {  
        $devis = Devis::create($request->all());
        return response()->json($devis);
    } 
    public function updateDevis(Request $request,$id)
    {     $devis = Devis::findOrFail($id);
          $devis->update($request->all());
          return $devis;
    }
   public  function deleteDevis($id)
   {
        $devis= Devis::findOrFail($id);
        $devis->delete();
        return 200;
   }
    public function getDevisArtisan($id)
    {  
       $devis = DB::table('devis')
       ->select('produits.libelle','produits.image','produits.prix','produits.promo','devis.prixpropose','devis.qte','devis.couleurSouhaite','devis.qtecouleur','devis.created_at as date','devis.idUser','devis.idProduit','devis.id')
        ->join('produits', 'produits.id', '=', 'devis.idProduit')
        ->where('produits.idUser','=', $id)
        ->where('devis.reponse','=', 'null')
        ->orderBy('date', 'DESC')
       ->get();
       return response()->json($devis);
    }
    public function getDevisClient($id)
    {  
       $devis = DB::table('devis')
       ->select('produits.libelle','produits.image','produits.prix','produits.promo','devis.prixpropose','devis.qte','devis.couleurSouhaite','devis.qtecouleur','devis.created_at as date','devis.idUser','devis.idProduit','devis.id','devis.reponse')
        ->join('produits', 'produits.id', '=', 'devis.idProduit')
        ->where('devis.idUser','=', $id)
        ->where('devis.reponse','!=', 'valide')
        ->orderBy('date', 'DESC')
       ->get();
       return response()->json($devis);
    }
    public function devisClient(Request  $r)
    {
      $iduser = DB::table('commandes')
      ->where('commandes.id', '=', $r->id)
      ->pluck('iduser');
      $email = DB::table('users')
      ->where('id', '=', $iduser)
      ->get('email');
      \Mail::to($email)->send(new devisClient($r->produit));
      return  $r->produit;
    }
    public function devisArtisan(Request  $r)
    { 
        $iduser = DB::table('users')
        ->join('produits', 'produits.idUser', '=', 'users.id')
        ->join('ligne_commandes', 'ligne_commandes.idProduit', '=', 'produits.id')
        ->where('ligne_commandes.idCommande','=', $r->id)
        ->distinct()
        ->pluck('users.id')
        ->toArray();
       for($i = 0;$i<count($iduser);$i++)
      { 
        $email[$i] = DB::table('users')
        ->join('produits', 'produits.idUser', '=', 'users.id')
        ->join('ligne_commandes', 'ligne_commandes.idProduit', '=', 'produits.id')
        ->where('ligne_commandes.idCommande','=',$r->id)
        ->where('produits.idUser', '=', $iduser[$i])
        ->distinct()
        ->get('email');
        \Mail::to($email[$i])->send(new devisArtisan($r->produit));  
      }

      
        return $r->produit;
    }
}