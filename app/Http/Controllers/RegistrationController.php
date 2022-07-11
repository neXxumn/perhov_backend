<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class RegistrationController extends Controller
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
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! user not created. please try again."]);
        }
    }
}
