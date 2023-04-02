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

    <div class="card mt-4">
        <div class="card-header fw-bolder">
            Comments
        </div>
        @foreach ($post->comments as $comment)
            <div class="card-body">
                <p class="card-text">{{ $comment->filename }}</p>
                <p class="card-text text-danger">{{ $comment->updated_at->diffForHumans() }}</p>
                {{-- <a href="{{ route('posts.editComment', [$comment->commentable_id, $comment->id]) }}"
                    class="btn btn-warning">Edit</a> --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Edit
                </button>
                <form action="{{ route('posts.deleteComment', $comment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">Delete</button>
                </form>
            </div>
        @endforeach
    </div>


    <div class="card mt-5">
        <div class="card-body p-4">
            <div class="d-flex flex-start w-100">

                <div class="w-100">
                    <h5>Add a comment</h5>

                    <form action="{{ route('posts.addComment', $post->id) }}" method="POST">
                        @csrf
                        <div class="form-outline">
                            <textarea class="form-control" id="" name="filename" rows="4"></textarea>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <button type="submit" class="btn btn-danger">
                                Send <i class="fas fa-long-arrow-alt-right ms-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Comment --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Comment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('posts.updateComment', $comment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="text" class="form-control" name="filename" value="{{ $comment->filename }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary">Save changes</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
