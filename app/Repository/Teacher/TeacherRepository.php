<?php

namespace App\Repository\Teacher;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Http\Resources\Teacher\IndexTeacherResource;
use App\Repository\Teacher\TeacherRepositoryInterface;

class TeacherRepository implements TeacherRepositoryInterface {

    /**
     * @return Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return IndexTeacherResource::collection(User::role('Teacher')
            ->with('teacher')
            ->whereHas('teacher')
            ->get());
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return bool
     */
    public function store(Request $request): bool
    {
        return DB::transaction(function () use ($request) {
            
            $user = User::create([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'email' => $request->email,
            ]);

            $user->assignRole('Teacher');
    
            $user->teacher()->create([
                'name' => $request->name,
                'email' => $request->email,
                'education' => $request->education,
                'gender' => $request->gender,
                'religion' => $request->religion,
                'appointment_decree' => $request->appointment_decree,
                'date' => $request->date,
                'road' => $request->road,
                'village' => $request->village,
                'subdistrict' => $request->subdistrict,
                'city' => $request->city,
                'province' => $request->province,
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

            return true;
        });
    }

    /**
     * @param App\Models\Teacher $teacher
     * @param Illuminate\Http\Request $request
     * @param array $data
     * @return bool
     */
    public function update(Request $request, Teacher $teacher)
    {
        DB::transaction(function () use ($request, $teacher) {
            $teacher->user()->update([
                'name' => $request->form['name'],
            ]);

            if (!is_null($request->form['password'])) {
                $teacher->user()->update([
                    'password' => Hash::make($request->form['password']),
                ]);
            }

            $teacher->update([
                'name' => $request->form['name'],
                'education' => $request->form['education'],
                'gender' => $request->form['gender'],
                'religion' => $request->form['religion'],
                'appointment_decree' => $request->form['appointment_decree'],
                'date' => $request->form['date'],
                'road' => $request->form['road'],
                'village' => $request->form['village'],
                'subdistrict' => $request->form['subdistrict'],
                'city' => $request->form['city'],
                'province' => $request->form['province'],
            ]);

            if ($request->hasFile('form.avatar')) {
            
                $file = $request->file('form.avatar');
                
                $name = $file->hashName();
                $path = storage_path('app/public/avatars/'.$name);
                Image::make($file)->resize(120, 120)->save($path);
                
                $teacher->user->update([
                    'avatar' => 'public/avatars/'.$name
                ]);
            }

            return true;
        });
    }

    /**
     * @param User $teacher
     * @return void
     */
    public function delete(User $teacher)
    {
        $teacher->delete();       
    }
}