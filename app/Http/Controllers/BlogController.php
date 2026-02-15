<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Support\HtmlString;

class BlogController extends Controller
{
    public function index(): View
    {
        $posts = Post::latest()->paginate(5);
        return view('public.blog.index', compact('posts'));
    }


    public function showCategory(Category $category)
    {
        $posts = $category->posts()->with('user')->paginate(10);
        return view('public.blog.category', compact('category', 'posts'));
    }


    public function showPost(Post $post)
    {
        return view('public.blog.post', compact('post'));
    }


    public function search(Request $request)
    {
        $searchText = trim($request->input('search_text'));
        if (empty($searchText)) {
            return redirect()->back()->with('error', 'Пожалуйста, введите текст для поиска');
        }
        $words = preg_split('/\s+/', $searchText);
        $filteredWords = array_filter($words, function($word) {
            return strlen(trim($word)) >= 2;
        });
        
        if (empty($filteredWords)) {
            return redirect()->back()->with('error', 'Слишком короткие слова для поиска');
        }
        
        $posts = Post::query();
        
        $posts->where(function($query) use ($filteredWords) {
            foreach ($filteredWords as $word) {
                $query->orWhere('title', 'LIKE', '%' . $word . '%')
                    ->orWhere('text', 'LIKE', '%' . $word . '%');
            }
        });
        
        $posts = $posts->paginate(9);

        // Подготавливаем данные для подсветки
        foreach ($posts as $post) {
            $post->highlighted_title = $this->highlightWords($post->title, $filteredWords);
            // $post->highlighted_text = $this->highlightWords(\Str::limit(strip_tags($post->text), 150), $filteredWords);
            $post->highlighted_text = $this->highlightWords(strip_tags($post->text), $filteredWords);
        }        
        
        return view('public.blog.search', compact('posts', 'searchText', 'filteredWords'));
    }

    private function highlightWords($text, $words)
    {
        foreach ($words as $word) {
            $text = preg_replace(
                "/($word)/iu",
                '<mark>$1</mark>',
                $text
            );
        }
    return new HtmlString($text);
    }    
}
