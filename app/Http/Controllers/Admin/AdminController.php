<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;

class AdminController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $postsCount = Post::count();
        $latestPosts = Post::latest()->take(5)->get();

        return view('admin.dashboard', compact('usersCount', 'postsCount', 'latestPosts'));
    }
}
