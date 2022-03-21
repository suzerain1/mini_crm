<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request) {

        $fields = $request->validate([
            'email'     => 'required|string',
            'password'  => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();
        
        if(!$user || !Hash::check($fields['password'], $user->password)) {

            return response([
                'errors' => 'Invalid Credentials'
            ], 401);

        }

        $token = $user->createToken('mytoken')->plainTextToken;
 
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);

    }

    public function storeToken(Request $request, $id) {

        $user = User::find($id);
        if(is_null($user)) {
            return response()->json(['msg' => 'User not found'], 404);
        }
        $user->remember_token = $request->token;
        $user->save();

        return response($user, 200);

    }

    public function logout(Request $request) {

        $request->user()->currentAccessToken()->delete();

        return[
            'msg' => 'Logged out'
        ];

    }

}
