@extends('layouts.admin')

@section('contents')
    <h1>Voted Websites by {{ $user->name }}</h1>

    @if($user->votedWebsites->isEmpty())
        <p>{{ $user->name }} has not voted for any websites.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user->votedWebsites as $website)
                    <tr>
                        <td>{{ $website->id }}</td>
                        <td>{{ $website->name }}</td>
                        <td><a href="{{ $website->url }}" target="_blank">{{ $website->url }}</a></td>
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
