<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class LikeController extends Controller
{
    public function toggle(Post $post)
    {
        $identifier = session()->getId(); // уникальный ID текущей сессии

        if ($post->like($identifier)) {
            return back()->with('success', 'Лайк поставлен!');
        }

        return back()->with('error', 'Вы уже ставили лайк этому посту сегодня.');
    }
}
