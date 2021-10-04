<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Http\Request;
use App\Http\Requests\SigupRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
class AuthController extends Controller
{
    
      /* public $successStatus = 200;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     **/
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['refresh','sendmessages','login','signup','signupAdmin','getAuthUser','updateUser','decrypt']]);
    }
    
     
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
     public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) 
       
          {  return response()->json(['error' => ' L\'email ou le password n\'existe pas'], 401);
           
          }
       return  $this->respondWithToken($token);
     
       
    }
   public function decrypt(Request $request)
   { 
    if (Hash::check($request->actuel,$request->pass)) {
        return response()->json('valide');
    }
    else 
    {
        
            return response()->json('invalide');
    }
  
   }
   

   
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60*24*7,
            'role'=>auth()->user()->role,
            'user' =>auth()->user(),
           'password' => auth()->user()->password,
        ]);
    }
    public function signup(SigupRequest $request)
    {  
     
        $user = User::create($request->all());
        $this->storeImage($user);
         return $this->login($user);
        
     
    } 
    public function signupAdmin(Request $request)
    {   $request->validate([
        
        
        'email' => 'required|email|unique:users',
        'password' =>'required |confirmed',
       
     ]);
        $user = User::create($request->all());
           return $this->login($user);
    } 
  
 private function storeImage($user)
    {    
      if (request()->has('image'))
      {
        $user->update([
            'image' => request()->image->store('uploads', 'public'),
        ]);
        $image = Image::make(public_path('storage/' . $user->image))->fit(300, 300, null, 'top-left');
        $image->save();
      }
    }
    
    public function getAuthUser(Request $request)
    {
        return response()->json(auth()->user());
    } 
   
    public function updateUser(Request $request, $id)
    { 
        $request->validate([
           'nom' => 'required',
           'prenom' => 'required',
           'datenaiss'=> 'required|Date',
           'adresse' => 'required',
           'idGouvernerat' => 'required',
           'tel'=>'required|Min:8|Max:8',
           'codePostal' => 'Integer|Min:4',
           'email' => 'required|unique:users,email,'.$id,         
           'image'=>'image',
        ]);
        $user = User::find($id);
        $user->update($request->all());
        $this->storeImage($user);
        
        return    $user ;
             
    }
   
  
}