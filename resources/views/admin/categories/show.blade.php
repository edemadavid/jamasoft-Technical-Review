@extends('layouts.admin')

@section('contents')
    <h1>{{ $category->name }} Category</h1>

    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back to Categories</a>

    <h2>Websites</h2>
    @if($category->websites->isEmpty())
        <p>No websites found in this category.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Vote Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($category->websites as $website)
                    <tr>
                        <td>{{ $website->id }}</td>
                        <td>{{ $website->title }}</td>
                        <td><a href="{{ $website->url }}" target="_blank">{{ $website->url }}</a></td>
                        <td>{{ $website->vote_count }}</td>
                        <td>
                            <a href="{{ route('admin.websites.edit', $website->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.websites.destroy', $website->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
