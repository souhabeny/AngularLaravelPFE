<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GouverneratRequest;
use App\Gouvernerat;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class GouverneratController extends Controller
{ public function __construct()
    {
       
    }
    public function index(){
        return Gouvernerat::all();
    }
    public function addGouvernerat(GouverneratRequest $request)
    {  
        $gouvernerat = Gouvernerat::create($request->all());
     
        return $gouvernerat;
    } 
    public function deleteGouvernerat($id)
    {
        $gouv=Gouvernerat::findOrFail($id);
        $gouv->delete();
        return 200;
    }
    
}
