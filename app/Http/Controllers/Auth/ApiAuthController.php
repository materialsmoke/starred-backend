<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->email;
        $credentials = $request->only('email', 'password');
        $attempt = Auth::attempt($credentials);

        if($attempt){
            $user = User::where('email', $username)->first();
            $token = $user->createToken('login')->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'expires_in' =>  31536000,
                'refresh_token' => "",
                'token_type' => "Bearer",
            ]);
        }

        return response()->json([ 'status' => false, 'message' => "username or password is wrong"]);
    }

    public function register(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $passwordConfirm = $request->passwordConfirm;
        $type = $request->type;

        if(empty($username) || empty($password) || empty($passwordConfirm) || empty($type)){
            abort(400, 'Please fill all the fields');
        }

        if($password !== $passwordConfirm){
            abort(400, 'Password confirm is not matched');
        }

        $user = User::where('email', $username)->first();
        
        if($user){
            $userIsValid = Auth::once(['email'=>$username,'password' => $password]);
            if(! $userIsValid){

                abort(400, 'This email is already exist');
            }
            
        }else{
            $user = new User;
            $user->name = '';
            $user->email = $username;
            $user->rule = 'user';
            $user->type = $type;
            $user->password = Hash::make($password);
            $user->save();
        }
        
        $token = $user->createToken('login')->accessToken;

        return response()->json([
            'access_token' => $token,
            'expires_in' =>  31536000,
            'refresh_token' => "",
            'token_type' => "Bearer",
        ]);
    }

    public function check(){
        if(Auth::check()){
            return response()->json(['message' => 'valid'], 200);
        }

        return response()->json(['message' => 'not valid'], 300);
    }

}
