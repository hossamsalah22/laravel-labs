<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public $posts = [
        ['id' => 1, 'title' => 'PHP', 'description' => 'Hello PHP', 'posted_by' => '1', 'created_at' => '2023-04-01 12:00:00'],
        ['id' => 2, 'title' => 'MySQL', 'description' => 'Hello MySQL', 'posted_by' => '1', 'created_at' => '2023-04-01 12:00:00'],
        ['id' => 3, 'title' => 'JS', 'description' => 'Hello JS', 'posted_by' => '3', 'created_at' => '2023-04-01 12:00:00'],
    ];
    public function index()
    {
        return view('posts.index', ['posts' => $this->posts]);
    }

    public function show($id)
    {
        $post = ['id' => 3, 'title' => 'JS', 'description' => 'Hello JS', 'posted_by' => '3', 'created_at' => '2023-04-01 12:00:00'];
        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        // dd($_POST);
        $newPost = array('id' => 4, 'title' => $_POST['title'], 'description' => $_POST['description'], 'posted_by' => $_POST['posted_by'], 'created_at' => '2023-04-01 12:12:12');
        array_push($this->posts, $newPost);
        return view('posts.index', ['posts' => $this->posts]);
    }

    public function edit($id)
    {
        $post = ['id' => 3, 'title' => 'JS', 'description' => 'Hello JS', 'posted_by' => '3', 'created_at' => '2023-04-01 12:00:00'];
        return view('posts.edit', ['post' => $post]);
    }

    public function update()
    {
        return view('posts.index', ['posts' => $this->posts]);
    }

    public function destroy($id)
    {
        foreach ($this->posts as $key => $post) {
            if ($post['id'] == $id) {
                unset($this->posts[$key]);
            }
        }
        return view('posts.index', ['posts' => $this->posts]);
    }
}