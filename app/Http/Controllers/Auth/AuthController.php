<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Contracts\ImageServiceInterface;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use File;


class AuthController extends Controller
{
    private ImageServiceInterface $imageService;

    public function __construct(ImageServiceInterface $imageService)
    {
        $this->imageService = $imageService;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $remember = $request->has('remember') && $request->filled('remember');

        if (Auth::attempt($request->only('email', 'password'), $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors(['email' => 'Wrong auth data']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',            
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('login')->with('status', 'Registration went successfuly');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'name'       => 'string|max:255',
            'email'      => 'string|max:255|email|unique:users,email,' . Auth::id(),
            'image'      => 'sometimes|image|mimes:jpeg,png,gif,webp|max:5048', 
        ]);

        $user = Auth::user();

        try {
            if ($request->hasFile('image')) {
                $newImageName = $this->imageService->saveAvatarInStorage($request);

                if ($user->image_name) {
                    $this->imageService->removeAvatarFromStorage($user->image_name);
                }


                $data['image_name'] = $newImageName;
            }
        } catch (\Exception $e) {
            \Log::error('Ошибка при загрузке изображения: ' . $e->getMessage());
            return redirect()
                ->route('profile')
                ->with('error', 'Произошла ошибка при загрузке изображения. Попробуйте снова.');
        }  

        $user->update($data);        

        return redirect()->route('profile');
    }


    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }


    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed'
        ]);

        $user = Auth::user();

        if (!Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Wrong current password!']);
        }

        $user->password = Hash::make($data['new_password']);
        $user->save();

        return redirect()->route('profile')->with('status', 'Password changed successfuly!');
    }

    // public function showAvatar($id)
    // {
    //     $user = User::findOrFail($id);

    //     if ($user->id !== auth()->id()) {
    //         abort(403);
    //     }

    //     $path = storage_path('app/private/' . $user->image_name);
    //     return response()->file($path);
    // }
}
