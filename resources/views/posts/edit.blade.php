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
                <option value="Hossam" {{ $post['posted_by'] == 'Hossam' ? 'selected' : '' }}>Hossam</option>
                <option value="Ali" {{ $post['posted_by'] == 'Ali' ? 'selected' : '' }}>Ali</option>
                <option value="Mohammed" {{ $post['posted_by'] == 'Mohammed' ? 'selected' : '' }}>Mohammed</option>

            </select>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@endsection
