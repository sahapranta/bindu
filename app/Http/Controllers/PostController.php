<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        return response()->json(Post::latest()->paginate(10)->toArray(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => 'string|required',
            "slug" => 'string|required|unique:posts',
            "description" => 'string',
            "thumbnail" => 'required|image',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('thumbnail')) {
            $filenameWithExt = $request->file('thumbnail')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('thumbnail')->storeAs('public/uploads/thumbs', $fileNameToStore);
        } else {
            $fileNameToStore = 'thumb.png';
        }

        $post = Post::create($request->only('title', 'slug', 'description') + [
            "user_id" => \Auth::id(),
            "thumbnail" => $fileNameToStore,
        ]);
        return response()->json($post, 201);
    }

    public function show(Post $post)
    {
        return response()->json($post, 200);
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->only('name', 'description', 'slug', 'status'));
        return response()->json($post, 200);
    }

    public function destroy(Post $post)
    {
        unlink('public/uploads/thumbs/' . $post->thumbnail);
        $post->delete();
        return response()->json(['message' => 'Issue Deleted Successfully'], 200);
    }
}
