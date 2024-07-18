@extends('layouts.admin')

@section('contents')
    <h1>Users and Count of Voted Websites</h1>

    @if($users->isEmpty())
        <p>No users found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Count of Voted Websites</th>
                    <th>View Voted Websites</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->votedWebsites()->count() }}</td>
                        <td>
                            <a href="{{ route('admin.votes.show', $user->id) }}" class="btn btn-primary">View Voted Websites</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
