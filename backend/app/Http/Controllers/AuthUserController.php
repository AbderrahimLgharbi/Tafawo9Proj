<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;

class AuthUserController extends Controller
{
    public function login(Request $request){
        // return response()->json(["msg"=>"Sds"]);/
        try{
            $data = [
                'email' => 'required|string|email',
                'password' => 'required|string'
            ];

            $validator = Validator::make($request->all(),$data);
            if($validator->fails()){
                return response()->json([
                    'msg' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }

            $credentials = $request->only('email','password');
            if(Auth::attempt($credentials)){
                $user = User::where("email",$request->email)->first();
                $token = $user->createToken("personal access token")->plainTextToken;
                $user->token = $token;
                return response()->json(["user"=>$user]);
            }
            return response()->json(["user"=>"These Credentials do not match "]);
        } catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function register(Request $request){
        try{

            $rules = [

                'name' => 'required|string',
                'email' => 'required|string|max:255|email|unique:users',
                'password' => 'required|string|min:6'
            ];

            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                return response()->json([
                    'msg' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if($user){
                $token = $user->createToken('apiToken')->plainTextToken;
                $user->token = $token;
                return response()->json(["user"=>$user]);
            }

        }
        catch(Exception $e){
            $e->getMessage();
        }
    }

    public function logout(Request $request){
    try {
        if ($request->user() && $request->user()->currentAccessToken()) {
            $request->user()->currentAccessToken()->delete();

            // Return success message
            return response()->json(["msg" => "You have been successfully logged out"]);
        }

        return response()->json(["msg" => "Wrong"], 401); // 401 for unauthorized

    } catch (Exception $e) {
        // Return a server error in case of unexpected failure
        return response()->json(["msg" => "Server Error", "error" => $e->getMessage()], 500); // 500 for internal server error
    }
}

}
