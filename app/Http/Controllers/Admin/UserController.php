<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()->is_root) {
            return redirect()->route('admin.dashboard');
        }

        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }

    public function showAvatar($id)
    {
        $user = User::findOrFail($id);

        if ($user->id !== auth()->id()) {
            abort(403);
        }

        $path = storage_path('app/public/images/avatars/' . $user->image_name);
        return response()->file($path);
    }   
    
    public function showAvatarByImageName($imageName)
    {
        $user = User::where('image_name', $imageName)->first();

        if (!$user) {
            // Путь к стандартной аватарке (например, public/img/default-avatar.png)
            $defaultPath = public_path('images/default-avatar.webp');
            if (file_exists($defaultPath)) {
                return response()->file($defaultPath);
            }
            abort(404);
        }

        $path = storage_path('app/public/images/avatars/' . $user->image_name);
        return response()->file($path);
    }      
}
