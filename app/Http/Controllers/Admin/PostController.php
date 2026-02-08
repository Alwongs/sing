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
                ->route('posts.index')
                ->with('error', 'Произошла ошибка при создании поста. Попробуйте снова.');
        }
       
        $redirect = $request->input('redirect', Post::ROUTE_TO_POSTS);
        $allowedRedirects = [
            Post::ROUTE_TO_POSTS,
            Post::ROUTE_TO_CATEGORY_POSTS,
        ];
        if (!in_array($redirect, $allowedRedirects)) {
            $redirect = Post::ROUTE_TO_POSTS;
        }
        if ($redirect === Post::ROUTE_TO_CATEGORY_POSTS && $post->category_id) {
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
                ->route('posts.index')
                ->with('error', 'Произошла ошибка при обновлении поста. Попробуйте снова.');
        }

        return redirect()
            ->route('posts.index')
            ->with('success', 'Пост успешно обновлён!');
    }


    public function destroy(Post $post)
    {
        $this->imageService->removeFromStorage($post->image_name);        
        $post->delete();
        return redirect()->route('posts.index');
    }
}
