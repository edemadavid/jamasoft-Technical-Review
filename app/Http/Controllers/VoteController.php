<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index()
    {
        $users = User::withCount('votedWebsites')->get();
        return view('admin.votes.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load('votedWebsites');
        return view('admin.votes.show', compact('user'));
    }
}
