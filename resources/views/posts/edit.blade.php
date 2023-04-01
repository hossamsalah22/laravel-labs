@extends('layouts.app')

@section('title')
    Edit
@endsection

@section('content')
    <form action="{{ route('posts.update', $post['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="my-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" value="{{ $post['title'] }}" required>
        </div>
        <div class="my-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" rows="3" required>{{ $post['description'] }}</textarea>
        </div>

        <div class="my-3">
            <label class="form-label">Creator</label>
            <select class="form-control" required>
                <option value="1" {{ $post['posted_by'] == 1 ? 'selected' : '' }}>Hossam</option>
                <option value="2" {{ $post['posted_by'] == 2 ? 'selected' : '' }}>Nader</option>
                <option value="2" {{ $post['posted_by'] == 3 ? 'selected' : '' }}>3bsi</option>

            </select>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@endsection
