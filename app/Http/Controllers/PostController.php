<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        
        return response()->json($posts, JsonResponse::HTTP_OK);
    }
    
    public function createPost(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "title" => "required",
                "content" => "required",
                "tags" => "required",
                "image"=>"required",
            ]
        );

        if ($validator->fails()) {
            return response()->json(["validation_errors" => $validator->errors()], JsonResponse::HTTP_RESET_CONTENT);
        }

        $news = Post::create([
            "user_id" => $request->user_id,
            "title" => $request->title,
            "content" => $request->content,
            "image"=> $request->image,
        ]);

        $this->createOrAddTags($request->tags, $news);
        return response()->json(["data" => $news], JsonResponse::HTTP_CREATED);
    }
    
    private function createOrAddTags($tags, $news)
    {
        $tags = explode(" ", $tags);
        foreach ($tags as $item) {
            $tags = Tag::firstOrCreate(
            ['tags' =>  $item]);
            $tags->save();
            $news->tags()->attach($tag->id);
        }
    }
    
    public function showTags($news_id)
    {
      $news = Post::find($news_id);
      $news->load(['tags']);
        return response()->json(["data" => $news], JsonResponse::HTTP_OK);
    }
}
