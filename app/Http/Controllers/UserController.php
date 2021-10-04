<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProduitRequest;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\SigupRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class UserController extends Controller
{   public function __construct()
    {
       
    }
    public function index(){
        return User::all();
    }
    public function indexDeactivate(){
        $now = Carbon::now()->year;
        $users = DB::table('users')
                ->whereYear('created_at', '<',$now)
                ->get();
        return $users;
    }
    public function deleteUser($id)
  {
      $user=User::findOrFail($id);
      if(Storage::move('public/'. $user->image, $user->image)) 
        {
            $user->delete();
            return 200;
        }
  }
}
