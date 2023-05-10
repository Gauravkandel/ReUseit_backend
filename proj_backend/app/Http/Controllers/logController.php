<?php

namespace App\Http\Controllers;

use App\Http\Requests\userRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class logController extends Controller
{
    public function register(userRequest $req)
    {
        $req->validated(); // Validation is done in userRequest helper inside app/Requests/userRequest

        $email_found = User::Where('email', $req->email)->first();
        if ($email_found) {
            return response([
                "msg" => "Email already exists"
            ], 401);
        }
        //making object of User model and inserting data
        $user = new User();
        $user->firstname = $req->firstname;
        $user->lastname = $req->lastname;
        $user->phone = $req->phone;
        $user->password = Hash::make($req->password);
        $user->email = $req->email;
        if ($user->save()) {
            return response([
                "msg" => "Registered successfully"
            ], 200);
        } else {
            return response([
                "msg" => "Error occured in registration"
            ], 401);
        }
    }
    public function login(Request $req)
    {

        $user = User::where('email', $req->email)->first(); //checks if the email is already present or not
        //if present performs action else return error
        if (!$user || !Hash::check($req->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }
        $token = $user->createToken('my-app-token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 200);
    }
    public function logout(request $req)
    {
        $user = User::find(Auth::user()->id);
        if ($user->tokens()->count() > 0) {
            if ($user->tokens()->delete()) {
                return response()->json([
                    'msg' => "Logged out"
                ], 200);
            }
        }
    }
}
