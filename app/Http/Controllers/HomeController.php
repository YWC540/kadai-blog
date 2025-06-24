<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index() {
        $blogs = Post::latest()->get();
        return view('home', compact('blogs'));
    }
}
