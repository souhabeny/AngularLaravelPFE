<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\likeRequest;
use App\Like;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class LikeController extends Controller
{
    public function __construct()
    {
       
    }
    public function index(){
        return Like::all();
    }

    public function addlike(Request $request,$pos)
    {  
        $like= array(
            'produit_id'       =>   $request->produit_id,
            'user_id'        =>   $request->user_id,
            'like'            =>   0
        );
        $likeadd = Like::create($like);
        $likes=DB::table('likes')
        ->where('like','=','0')
        ->where('produit_id','=',$request->produit_id)
        ->get();
        $nblikes=$likes->count();
        event(new \App\Events\likeEvent($nblikes,$pos,$request->produit_id));

        return $likeadd;
    }

    public function addDislike(Request $request,$posd)
    {  
        $dislike= array(
            'produit_id'       =>   $request->produit_id,
            'user_id'        =>   $request->user_id,
            'like'            =>   1
        );
        $dislikeadd = Like::create($dislike);
        $dislikes=DB::table('likes')
        ->where('like','=','1')
        ->where('produit_id','=',$request->produit_id)
        ->get();
        $nbdislikes=$dislikes->count();
        event(new \App\Events\dislikeEvent($nbdislikes,$posd,$request->produit_id));
         
        return $dislikeadd;
    }
    
    
    
    public function countlikes($id)
    {
      $likes=DB::table('likes')
      ->where('like','=','0')
      ->where('produit_id','=',$id)
      ->get();
      $nblikes=$likes->count();
      return $nblikes;
    }
    public function countdislikes($id)
    {
        $dislikes=DB::table('likes')
        ->where('like','=','1')
        ->where('produit_id','=',$id)
        ->get();
        $nbdlikes=$dislikes->count();
        return $nbdlikes;
    }
    public function existlikes($idu,$idp)
    {
        $likes=DB::table('likes')
        ->where('like','=','0')
        ->where('produit_id','=',$idp)
        ->where('user_id','=',$idu)
        ->get();
       
        return $likes;
    }

    public function existdislikes($idu,$idp)
    {
        $dislikes=DB::table('likes')
        ->where('like','=','1')
        ->where('produit_id','=',$idp)
        ->where('user_id','=',$idu)
        ->get();
       
        return $dislikes;
    }
    public function deletedislike($idp,$idu)
    {
        $dislikes=DB::table('likes')
        ->where('like','=','1')
        ->where('produit_id','=',$idp)
        ->where('user_id','=',$idu)
        ->delete();
        
        return 200;
    }
    public function deletelike($idp,$idu)
    {
        $dislikes=DB::table('likes')
        ->where('like','=','0')
        ->where('produit_id','=',$idp)
        ->where('user_id','=',$idu)
        ->delete();
        
        return 200;
    }
}
