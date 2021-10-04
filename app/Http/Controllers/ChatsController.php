<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Http\Requests\chatRequest;
use Illuminate\Support\Facades\DB;
use App\Events\MessageSent;
class ChatsController extends Controller
{
    public function __construct()
    {
       
    }
    public function index()
    {
        return view('chats');
    }
    public function fetchmessages($id,$idc)
    { $messages= DB::table('messages')
      ->join('users as c', 'c.id','=','messages.idClient')
      //->join('users as a', 'a.id','=','messages.idArtisan')
      ->where('messages.idClient','=',$idc)
      ->where('messages.idArtisan','=',$id)
      ->orwhere('messages.idArtisan','=',$idc)
      ->where('messages.idClient','=',$id)
      //->groupBy('id')
      ->orderBy('messages.created_at', 'asc')
      ->get();
        
        return $messages;
    }
    public function getUsersSendMessage($id)
    {
        $idusers= DB::table('messages')
        ->select('messages.idArtisan','messages.idClient')
        ->join('users as a', 'a.id','=','messages.idClient')
        ->where('messages.idArtisan','=',$id)
        ->orwhere('messages.idClient','=',$id)
        ->distinct()
        ->pluck('messages.idArtisan');

        $idusers2= DB::table('messages')
        ->select('messages.idArtisan','messages.idClient')
        ->join('users as a', 'a.id','=','messages.idClient')
        ->where('messages.idArtisan','=',$id)
        ->orwhere('messages.idClient','=',$id)
        ->distinct()
        ->pluck('messages.idClient');

        $messages=DB::table('users')
        ->whereIn('id',$idusers)
        ->orwhereIn('id',$idusers2)
        ->get();
    
    
        return $messages;
    }
    
    public  function  sendmessages(Request $request)
    { 
      
        $message= array(
            'message'       =>   $request->message,
            'idClient'        =>   $request->idClient,
            'idArtisan'            =>   $request->idArtisan
        );
        $messages= DB::table('messages')
        ->join('users', 'users.id','=','messages.idArtisan')
        ->where('messages.idClient','=',$request->idClient)
        ->where('messages.idArtisan','=',$request->idArtisan)
        ->get();
        $msg = Message::create($message);
         event(new \App\Events\Event($message));
            
           return $message ;
      
    }

}
