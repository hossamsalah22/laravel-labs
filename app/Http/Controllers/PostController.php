<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public $posts = [
        ['id' => 1, 'title' => 'PHP', 'description' => 'Hello PHP', 'posted_by' => 'Hossam', 'created_at' => '2023-04-01 12:00:00'],
        ['id' => 2, 'title' => 'MySQL', 'description' => 'Hello MySQL', 'posted_by' => 'Ali', 'created_at' => '2023-04-01 12:00:00'],
        ['id' => 3, 'title' => 'JS', 'description' => 'Hello JS', 'posted_by' => 'Mohammed', 'created_at' => '2023-04-01 12:00:00'],
    ];
    public function index()
    {
        return view('posts.index', ['posts' => $this->posts]);
    }

    public function show($id)
    {
        $post = [];
        foreach ($this->posts as $searchPost) {
            if ($searchPost['id'] == $id) {
                $post = $searchPost;
            }
        }
        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $post = [];
        foreach ($this->posts as $searchPost) {
            if ($searchPost['id'] == $id) {
                $post = $searchPost;
            }
        }
        return view('posts.edit', ['post' => $post]);
    }

    public function update()
    {
        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        return redirect()->route('posts.index');
    }
}
