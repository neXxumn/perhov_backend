<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagsController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            "tag" => "required" 
        ]);

        if ($validator->fails()) {
            return response()->json(["validation_errors" => $validator->errors()], JsonResponse::HTTP_RESET_CONTENT);
        }
        else {
            $tags = Tag::create([
                "tags" => $request->tags,
            ]);
            return response()->json(["data" => $tags], JsonResponse::HTTP_CREATED);
        }
    }
}
