<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProduitRequest;
use App\Produit;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\SigupRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class ProduitController extends Controller
{  public function __construct()
    {
       
    }
    public function addProduct(ProduitRequest $request)
    {  
     
        $produit = Produit::create($request->all());
        $this->storeImage($produit);
        return $produit;
    } 

    public function index()
    {
        return Produit::all();
    }
    public function indexbyuser($idUser) 
    { 
        $produit = DB::table('produits')->where('idUser', $idUser)->get();
        return response()->json($produit);
    }
    public function produitbyid($id) 
    {  
        $produit = DB::table('produits')->where('id', $id)
        ->get();
        return $produit;
    } 
    public function produitpromo() 
    {  
        $produit = DB::table('produits')->where('promo','>',10)->get();
        return response()->json($produit);
    } 
    public function delete(Request $request,$id)
    {
        $produit=Produit::findOrFail($id);
      if(Storage::move('public/'.$produit->image, $produit->image)) 
      {$produit->delete();
        return 200;
      }
    }
    public function updateProduct(Request  $request, $id)
  {    $request->validate([
           'libelle' => 'required',
           'description' => 'required',
           'couleur'=>'string',
           'image'=>'image',
           'prix' => 'required | Numeric',
           'promo'=> 'Numeric | between:0,99.99',
           'idCategorie' => 'required',
           'idUser' => 'required',
 ]);
     $produit=Produit::find($id);
      $produit->update($request->all());
      $this->storeImage($produit);
      return  $produit;
  }
    private function storeImage($produit)
    {    
      if (request()->has('image'))
      {
        $produit->update([
            'image' => request()->image->store('img', 'public'),
        ]);
      $image = Image::make(public_path('storage/' . $produit->image))->fit(500, 300, null, 'top-left');
       $image->save();
       
      }
     
    }
    public function getprodbycategorie($id)
    {
      $produit = DB::table('produits')->where('idCategorie', $id)->get();
      return response()->json($produit);
    }
    public function getproduitOrderByDate()
    {
      $produits=DB::table('produits')
      ->join('users', 'produits.idUser', '=', 'users.id')
      ->select('produits.*','users.nom', 'users.prenom','users.image as imguser')
      ->orderBy('created_at', 'DESC')
      ->get();
      return $produits;
    }
    public function countproduitUser($id)
    {
      $prods=DB::table('produits')->where('idUser', $id)->get();
      $nbprod=$prods->count();
      return $nbprod;
    }
}
