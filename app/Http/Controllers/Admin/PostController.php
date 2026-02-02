<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    public function createCategoryPost(Category $category)
    {
        $categories = Category::all();        
        $category_id = $category->id;

        return view('admin.posts.create', compact('categories', 'category_id'));
    }




    public function store(StoreRequest $request): RedirectResponse
    {
        $post = Post::create($request->validated());

        $redirect = $request->input('redirect', Post::REDIRECT_POSTS);
        $allowedRedirects = [
            Post::REDIRECT_POSTS,
            Post::REDIRECT_CATEGORY_POSTS,
        ];

        if (!in_array($redirect, $allowedRedirects)) {
            $redirect = Post::REDIRECT_POSTS;
        }

        if ($redirect === Post::REDIRECT_CATEGORY_POSTS && $post->category) {
            return redirect()
                ->route($redirect, $post->category)
                ->with('success', 'Пост успешно создан!');
        }

        return redirect()
            ->route($redirect, $post)
            ->with('success', 'Пост успешно создан!');
    }




    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return  view('admin.posts.edit', compact('post'));
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $post->update($request->validated());

        return redirect()
            ->route('posts.index')
            ->with('success', 'Пост успешно обновлён!');
    }


    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
