<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class AuthorizationController extends Controller
{
    public function userLogin(Request $request) {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('token')->accessToken;

            return response()->json(["status" => true, "success" => true, "login" => true, "token" => $token, "data" => $user], JsonResponse::HTTP_CREATED);
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! invalid email or password"]);
        }
    }
}
