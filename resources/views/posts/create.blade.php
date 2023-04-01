@extends('layouts.app')

@section('title')
    Create
@endsection

@section('content')
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="my-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="my-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3" required></textarea>
        </div>

        <div class="my-3">
            <label class="form-label">Creator</label>
            <select class="form-control" name="posted_by" required>
                <option value="Hossam">Hossam</option>
                <option value="Ali">Ali</option>
                <option value="Mohammed">Mohammed</option>
            </select>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@endsection
