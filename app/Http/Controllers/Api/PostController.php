<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->paginate(10);
        return PostResource::collection($posts);
    }

    function show($id)
    {
        $post = Post::find($id);
        if($post) return new PostResource($post);
        else return response()->json("Post Not Found", 404);
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->all());
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move('uploads/posts', $image_new_name);
            $post->image = 'uploads/posts/' . $image_new_name;
        }
        $post->save();
        return new PostResource($post);
    }

    public function update(UpdatePostRequest $request, $id)
    {
        // $client = $request->user();
        $post = Post::find($id);
        if ($post) {
            $post->update($request->except('image'));
            if ($request->hasFile('image')) {
                $old_image = $post->image;
                $image = $request->image;
                $image_new_name = time() . $image->getClientOriginalName();
                if ($image->move('uploads/posts', $image_new_name)) {
                    unlink($old_image);
                }
                $post->image = 'uploads/posts/' . $image_new_name;
            }
        }
        $post->save();

        return new PostResource($post);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();

            return response()->json("Post Deleted Successfully", 200);
        }
        else {
            return  response()->json("Post Not Found", 404);
        }
    }
}
