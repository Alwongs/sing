<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Post;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use File;
use Illuminate\Support\Facades\Storage;
use App\Contracts\ImageServiceInterface;

class PostController extends Controller
{
    private ImageServiceInterface $imageService;

    public function __construct(ImageServiceInterface $imageService)
    {
        $this->imageService = $imageService;
    }
    
    public function index()
    {
        $posts = Post::where('user_id', auth()->user()->id)->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function getAllUsersPosts()
    {
        $posts = Post::all();        
        return view('admin.posts.index', compact('posts'));        
    }

    public function create()
    {
        redirect()->setIntendedUrl(url()->previous());
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function createCategoryPost(Category $category)
    {
        redirect()->setIntendedUrl(url()->previous());        
        $categories = Category::all();        
        $category_id = $category->id;
        return view('admin.posts.create', compact('categories', 'category_id'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            if ($request->hasFile('image')) {
                $newImageName = $this->imageService->saveInStorage($request);
                $validated['image_name'] = $newImageName;
            }

            $post = Post::create($validated);

        } catch (\Exception $e) {
            \Log::error('Ошибка при создании поста: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Произошла ошибка при создании поста. Попробуйте снова.');
        }
       
        return redirect()
            ->intended(route('posts.index'))
            ->with('success', 'Пост создан!');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        redirect()->setIntendedUrl(url()->previous());
        return  view('admin.posts.edit', compact('post'));
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $validated = $request->validated();
        try {
            if ($request->hasFile('image')) {
                $newImageName = $this->imageService->saveInStorage($request);
                if ($post->image_name) {
                    $this->imageService->removeFromStorage($post->image_name);
                }
                $validated['image_name'] = $newImageName;
            }
            $post->update($validated);

        } catch (\Exception $e) {
            \Log::error('Ошибка при обновлении поста: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Произошла ошибка при обновлении поста. Попробуйте снова.');
        }
        return redirect()
            ->intended(route('posts.index'))
            ->with('success', 'Post updated');
    }

    public function destroy(Post $post)
    {
        if ($post->image_name) {
            $this->imageService->removeFromStorage($post->image_name); 
        }
        $post->delete();
        return redirect()->back()->with('success', 'Post deleted.');
    }
}
