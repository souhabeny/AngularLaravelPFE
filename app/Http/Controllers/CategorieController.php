<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategorieRequest;
use App\Categorie;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategorieController extends Controller
{
    public function __construct()
    {
       
    }
    public function index(){
        return Categorie::all();
    }
    public function addCategorie(CategorieRequest $request)
    {  
     
        $categorie = Categorie::create($request->all());
     
        return $categorie;
    } 
    public function deleteCategorie($id)
    {
        $categorie=Categorie::findOrFail($id);
        $categorie->delete();
        return 200;
    }
}
