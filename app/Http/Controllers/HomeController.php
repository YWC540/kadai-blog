<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index() {
        $blogs = Post::with(['user', 'likes'])->latest()->paginate(10);
        return view('home', compact('blogs'));
    }
}
