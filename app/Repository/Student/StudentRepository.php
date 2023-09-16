<?php

namespace App\Repository\Student;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Http\Resources\Student\IndexStudentResource;
use App\Repository\Student\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface {

    /**
     * @return Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return IndexStudentResource::collection(User::role('Student')
            ->with('student', 'student.school_class', 'student.study_group')
            ->whereHas('student')
            ->get());
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return bool
     */
    public function store(Request $request): bool
    {
        return DB::transaction(function () use ($request) {
            
            try {
                $user = User::create([
                    'name' => $request->name,
                    'password' => Hash::make($request->password),
                    'email' => $request->email,
                ]);
    
                $user->assignRole('Student');
        
                $user->student()->create([
                    'class_id' => $request->class_id,
                    'study_group_id' => $request->study_group_id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'NISN_number' => $request->NISN_number,
                    'gender' => $request->gender,
                    'religion' => $request->religion,
                    'date_of_birth' => $request->date('date_of_birth'),
                    'place_of_birth' => $request->place_of_birth,
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
            } catch (\Throwable $th) {
                logError($th);
                return false;
            }
        });
    }

    /**
     * @param App\Models\Student $student
     * @param Illuminate\Http\Request $request
     * @param array $data
     * @return bool
     */
    public function update(Request $request, Student $student)
    {
        return DB::transaction(function () use ($request, $student) {
            try {

                $student->user()->update([
                    'name' => $request->form['name'],
                ]);

                if (!is_null($request->form['password'])) {
                    $student->user()->update([
                        'password' => Hash::make($request->form['password']),
                    ]);
                }
                $student->update([
                    'class_id' => $request->form['class_id'],
                    'study_group_id' => $request->form['study_group_id'],
                    'name' => $request->form['name'],
                    'email' => $request->form['email'],
                    'NISN_number' => $request->form['NISN_number'],
                    'gender' => $request->form['gender'],
                    'religion' => $request->form['religion'],
                    'date_of_birth' => parseDate($request->form['date_of_birth']),
                    'place_of_birth' => $request->form['place_of_birth'],
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
                    
                    $student->user->update([
                        'avatar' => 'public/avatars/'.$name
                    ]);
                }
                return true;
            } catch (\Throwable $th) {
                logError($th);
                return false;
            }
        });
    }
}