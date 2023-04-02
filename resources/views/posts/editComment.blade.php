@extends('layouts.app')

@section('title')
    Edit
@endsection

@section('content')
    <div class="card mt-5">
        <div class="card-body p-4">
            <div class="d-flex flex-start w-100">

                <div class="w-100">
                    <h5>Edit a comment</h5>

                    <form action="{{ route('posts.updateComment', $comment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-outline">
                            <textarea class="form-control" id="" name="filename" rows="4">{{ $comment->filename }}</textarea>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <button type="submit" class="btn btn-danger">
                                Update <i class="fas fa-long-arrow-alt-right ms-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
