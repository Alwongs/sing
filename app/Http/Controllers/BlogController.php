<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $posts = Post::latest()->paginate(5);
        return view('public.blog.index', compact('posts'));
    }

    public function category(Category $category)
    {
        $posts = $category->posts()->with('user')->paginate(10);
        return view('public.blog.category', compact('category', 'posts'));
    }

    public function search()
    {
        return 4;
    }
}
