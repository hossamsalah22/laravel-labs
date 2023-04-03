@extends('layouts.app')

@section('title')
    Create
@endsection

@section('content')

    <h1 class="text-center mt-3">Create Post</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="my-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>
        <div class="my-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="my-3">
            <label class="form-label">Creator</label>
            <select class="form-control" name="user_id">
                <option value="" selected disabled>Select User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@endsection
