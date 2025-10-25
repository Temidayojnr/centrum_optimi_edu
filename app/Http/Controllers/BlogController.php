<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'published')
            ->latest('published_at')
            ->paginate(9);

        $featured_post = Post::where('status', 'published')
            ->where('is_featured', true)
            ->latest('published_at')
            ->first();

        return view('blog.index', compact('posts', 'featured_post'));
    }

    public function show(Post $post)
    {
        if ($post->status !== 'published') {
            abort(404);
        }

        // Increment views
        $post->increment('views');

        $related_posts = Post::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'related_posts'));
    }
}
