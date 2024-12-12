<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PasswordResources;
use App\Http\Resources\UserResources;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\PostDec;
use PhpParser\Node\Expr\PostInc;
use PHPUnit\Framework\Attributes\PostCondition;

class UserController extends Controller
{
        public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required','email',
            'password' => [ 'required'],
        ]);
        
        $user = User::where('email', $validatedData['email'])->first();
        $token = $user->createToken('auth-token')->accessToken;
        
        
            
        if ($user && Hash::check($validatedData['password'], $user->password)) {
                
            return response()->json([
                new UserResources($user),
                'token'  => $token,
                'message'=> 'User login Successfully',
                'status' => 1
            ]);
            
        } else {
            return "Email or Password dose not match";
        }
    }
    
    public function store(Request $request){
        $request->validate([
            'name'=> 'required',
            'email' => 'required','email','uniqid',
            'password' => [ 'required','min:6'],
            'password_confirmation' => [ 'required','same:password','min:6'],
            'user_image'=>'required'

        ]);
        
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $bloguser = User::create($input);
        
        return new UserResources($bloguser);
    }

    
    

    public function index(Request $request)
    {
           $search = $request['search'] ?? "";
        if ($search != "") {
            $blogusers = User::where('name', 'like', "%$search%")
                             ->orWhere('email', 'like', "%$search%")
                             ->get();
        } else {
            $blogusers = User::all();
        }
        return UserResources::collection($blogusers);
        
    }



    
     public function edit($id)
    {
        $bloguser = User::find($id);
        $input['password'] = Hash::make($bloguser['password']);
         if($input == null){
            return 'user not found';
         }

        return $input;
    }



    
     public function update(Request $request,$id)
    {

        $bloguser = user::find($id);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        
        if($bloguser->update($input)){
                return new UserResources($bloguser);
            
        }
    } 



    
    public function delete($id){
        if($bloguser = user::find($id)->delete())
        return "User deleted successfully";
        
    }


 public function password(Request $request)
{
    $request->validate([
       'password'=>'required',
       'new_password'=>'required|min:6',
       'password_confirmation' =>'required|min:6|same:new_password' 
    ]);
    
    $userId = Auth::user()->id;
    $user = User::find($userId);
    
    if(!Hash::check($request->password, $user->password)){
        return response()->json([
            'message' => 'Current password dose not match.',
        ]);
    }
    $user->password = Hash::make($request->new_password);
    $user->save();
    
    return response()->json([
        'message' => 'Password updated successfully.',
    ]);
    
}

  
   
  


}