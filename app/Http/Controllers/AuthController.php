<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class AuthController extends Controller
{
    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:30',
            'name' => 'required|max:30',
            'password' => 'required|alpha_num|min:6|max:30',
        ]);

        if ($validator->fails()) {
            return response()->json(["validation_errors" => $validator->errors()],
                JsonResponse::HTTP_BAD_REQUEST);
        }

        $newUser = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ]);

        if(!is_null($newUser)) {
            return response()->json(["data" => $newUser], JsonResponse::HTTP_CREATED);
        }

        else {
            return response()->json(JsonResponse::HTTP_RESET_CONTENT);
        }
    }

    public function userLogin(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('token')->accessToken;

            return response()->json(["login" => true, "token" => $token, "data" => $user], JsonResponse::HTTP_CREATED);
        }
        else {
            return response()->json(JsonResponse::HTTP_RESET_CONTENT);
        }
    }
}
