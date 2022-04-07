<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->all(['email', 'password']);
        $token = auth('api')->attempt($credentials);

        if (!$token) {
            return response()->json(['error' => 'Usuário e/ou senha inválido!'], Response::HTTP_FORBIDDEN);
        }

        return response()->json(['token' => $token]);
    }

    public function logout()
    {
        return 'logout';
    }

    public function refresh()
    {
        return 'refresh';
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
}
