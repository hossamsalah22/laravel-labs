@extends('layouts.app')

@section('title')
    Edit
@endsection

@section('content')
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="my-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ $post->title }}" required>
        </div>
        <div class="my-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" rows="3" name="description" required>{{ $post->description }}</textarea>
        </div>

        <div class="my-3">
            <label class="form-label">Creator</label>
            <select class="form-control" name="user_id" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $post['user_id'] == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@endsection
