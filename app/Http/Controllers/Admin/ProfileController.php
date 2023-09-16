<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Admin\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return Inertia::render('Admin/Profile', [
            'user' => $user,
            'avatar' => $user->getAvatar(),
        ]);
    }

    public function store(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->hasFile('avatar')) {
            
            $file = $request->file('avatar');
            
            $name = $file->hashName();
            $path = storage_path('app/public/avatars/'.$name);
            Image::make($file)->resize(120, 120)->save($path);
            
            $user->update([
                'avatar' => 'public/avatars/'.$name
            ]);
        }

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }
}
