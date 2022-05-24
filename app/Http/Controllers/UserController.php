<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class UserController extends Controller
{
    public function login(Request $request)
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->errors();
        }
        
        // tot i que el user i password son iguals no hem pogut validar
        
        
        $user = User::whereEmail($request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('Laravel')->accessToken;
            return response()->json([
                'res' => true,
                'token' => $token,
                'message' => 'Benvingut al sistema',
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Email o password incorrecte',
                'email' => $user,
                'req-pass' => $request->password,
                'us-pass' => $user->password,
                'req-us' => $request->email,
                'us-us' => $user->email,
            ], 400);
        }
    }

}
