@extends('layouts.app')

@section('title')
    Show
@endsection

@section('content')
    <div class="card mt-4">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{ $post->title }}</h5>
            <p class="card-text">Description: {{ $post->description }}</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Creator Name: {{ $post->user->name }}</h5>
            <p class="card-text">Creator Name: {{ $post->user->email }}</p>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-body p-4">
            <div class="d-flex flex-start w-100">

                <div class="w-100">
                    <h5>Add a comment</h5>

                    <form action="">
                        <div class="form-outline">
                            <textarea class="form-control" id="textAreaExample" rows="4"></textarea>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-danger">
                                Send <i class="fas fa-long-arrow-alt-right ms-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
