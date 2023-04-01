@extends('layouts.app')

@section('title')
    Index
@endsection

@section('content')
    <div class="text-center">
        <a href="{{ route('posts.create') }}" class="btn btn-success form-control mt-5">Create Post</a>
    </div>
    <table class="table table-dark table-responsive text-center mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post['id'] }}</td>
                    <td>{{ $post['title'] }}</td>
                    <td>{{ $post['posted_by'] }}</td>
                    <td>{{ $post['created_at'] }}</td>
                    <td>
                        <a href="{{ route('posts.show', $post['id']) }}" class="btn btn-primary">View</a>
                        <a href="{{ route('posts.edit', $post['id']) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('posts.destroy', $post['id']) }}" class="btn btn-danger"
                            onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">Delete</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
