@extends('layouts.admin')

@section('contents')
    <h1>Websites</h1>
    <a href="{{ route('admin.websites.create') }}" class="btn btn-primary">Add New Website</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>URL</th>
                <th>Categories</th>
                <th>Vote Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($websites as $website)
                <tr>
                    <td>{{ $website->id }}</td>
                    <td>{{ $website->title }}</td>
                    <td><a href="{{ $website->url }}" target="_blank">{{ $website->url }}</a></td>
                    <td>
                        {{ $website->category->name}}</span>
                    </td>
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
@endsection
