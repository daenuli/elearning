<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\GlobalSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class LogoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return Inertia::render('Admin/Logo', [
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {   
        if ($request->hasFile('logo')) {
            
            $file = $request->file('logo');
            $name = $file->getClientOriginalName();
            $path = public_path("images/{$name}");
            Image::make($file)->resize(120, 120)->save($path);
            Cache::forever('logo', $name);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Logo updated successfully.');
    }
}
