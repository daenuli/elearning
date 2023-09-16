<?php

namespace App\Http\Controllers\Student;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = $user->student;
        return Inertia::render('Student/Profile', [
            'user' => $user->load('student.school_class'),
            'study_group' => $student->study_group->name,
            'avatar' => $user->getAvatar(),
        ]);
    }

    public function store(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->student->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        if (!is_null($request->password)) {
            $user->update([
                'password' => Hash::make($request->password),
            ]); 
        }

        if ($request->hasFile('avatar')) {
            
            $file = $request->file('avatar');
            
            $name = $file->hashName();
            $path = storage_path('app/public/avatars/'.$name);
            Image::make($file)->resize(120, 120)->save($path);
            
            $user->update([
                'avatar' => 'public/avatars/'.$name
            ]);
        }

        return redirect()->route('student.profile')->with('success', 'Profile updated successfully.');
    }
}
