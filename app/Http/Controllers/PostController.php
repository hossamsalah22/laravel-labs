<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\PruneOldPostsJob;
use Illuminate\Support\Facades\Queue;

Queue::push(new PruneOldPostsJob);

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts.index', ['posts' => $posts]);
    }

    public function show($id)
    {
        $post = Post::with('comments')->where('id', $id)->first();
        // $post = Post::findOrFail($id)->with('comments');
        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create', ['users' => $users]);
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
        return to_route('posts.index');
    }

    public function edit($id)
    {

        $users = User::all();
        $post = Post::find($id);
        return view('posts.edit', ['post' => $post, 'users' => $users]);
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

        return to_route('posts.index');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
        }
        return redirect()->route('posts.index');
    }

    public function addComment($id, Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        $post = Post::findOrFail($id);
        $post->comments()->create([
            'filename' => $data['filename']
        ]);
        return redirect()->back();
    }

    public function updateComment(Request $request, $id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->filename = $request->filename;
        }
        $comment->save();

        return redirect()->route('posts.show', $comment->commentable_id);
    }

    public function deleteComment($id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->delete();
        }
        return redirect()->back();
    }

    public function restore()
    {
        Post::withTrashed()
            ->restore();
        return redirect()->back();
    }
}
