<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $blogs = Post::with(['user', 'likes'])->latest()->paginate(10);

        $user = auth()->user();

        $likeRanking = Post::with('user')
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->take(5)
            ->get();
        
        return view('home', compact('blogs', 'likeRanking', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('SUPABASE_API_KEY'),
                'apikey' => env('SUPABASE_API_KEY'),
            ])->attach(
                'file', file_get_contents($file), $filename
            )->post(env('SUPABASE_URL') . '/storage/v1/object/' . env('SUPABASE_BUCKET') . '/' . $filename);

            if ($response->successful()) {
                $imageUrl = env('SUPABASE_URL') . '/storage/v1/object/' . env('SUPABASE_BUCKET') . '/' . $filename;
            }
        }
        
        Post::create([
            'user_id' => \Auth::id(),
            'body' => $request->content,
            'image_path' => $imageUrl,
        ]);

        return redirect()->back()->with('success', 'Published successfully!');
    }

    public function toggleLike(Post $post)
    {
        $user = auth()->user();
        $like = $post->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            $post->likes()->create([
                'user_id' => $user->id,
            ]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likes_count' => $post->likes()->count(),
        ]);
    }

    public function likedBlogs()
    {
        $user = auth()->user();
        $blogs = $user->likedPosts()->with('user')->latest()->paginate(10);

        return view('posts.liked', compact('blogs'));
    }
}
