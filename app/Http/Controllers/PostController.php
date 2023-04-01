<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $posts = [
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
        return view('posts.show', ['post' => $this->posts[$id]]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        return view('posts.index', ['posts' => $this->posts]);
    }

    public function edit($id)
    {
        return view('posts.edit', ['post' => $this->posts[$id]]);
    }

    public function update()
    {
        return view('posts.index', ['posts' => $this->posts]);
    }

    public function destroy($id)
    {
        return view('posts.index', ['posts' => $this->posts]);
    }
}