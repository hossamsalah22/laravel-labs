@extends('layouts.app')

@section('title')
    Index
@endsection

@section('content')
    <div class="text-center">
        <a href="{{ route('posts.create') }}" class="btn btn-success form-control mt-5">Create Post</a>
        <a href="{{ route('posts.restore') }}"
            onclick="return confirm('{{ __('Are you sure you want to Restore All Posts?') }}')"
            class="btn btn-danger form-control mt-5">Restore All Posts</a>
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
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->human_readable_date }}</td>
                    {{-- <td>{{ $post->created_at->diffForHumans() }}</td> --}}
                    <td>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">View</a>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="pagination justify-content-center">
        {{ $posts->links() }}
    </div>
@endsection
