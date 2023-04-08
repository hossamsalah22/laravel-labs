@extends('layouts.app')

@section('title')
    Edit
@endsection

@section('content')
    <h1 class="text-center mt-3">Update Post</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="my-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') ? old('title') : $post->title }}">
        </div>
        <div class="my-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" rows="3" name="description">{{ old('description') ? old('description') : $post->description }}</textarea>
        </div>

        <div class="my-3">
            <label class="form-label">Creator</label>
            <select class="form-control" name="user_id">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $post['user_id'] == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach

            </select>
        </div>


        <div class="my-3">
            <label class="col-sm-3 col-form-label">Image</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" name="image" />
            </div>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@endsection
