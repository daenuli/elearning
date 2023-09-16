<?php

namespace App\Repository\StudyGroup;

use App\Models\User;
use App\Models\Student;
use App\Models\StudyGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Repository\StudyGroup\StudyGroupRepositoryInterface;

class StudyGroupRepository implements StudyGroupRepositoryInterface {

    /**
     * @return 
     */
    public function index()
    {
        return StudyGroup::all();
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
                    'passworsd' => Hash::make($request->password),
                    'email' => $request->email,
                ]);
    
                $user->assignRole('Student');
        
                $user->student()->create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'teacher_id' => $request->teacher_id,
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
                    $path = $request->file('avatar')->store('public/avatars');
                    $user->update([
                        'avatar' => $path
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
                    'name' => $request->form['name'],
                    'email' => $request->form['email'],
                    'NISN_number' => $request->form['NISN_number'],
                    'gender' => $request->form['gender'],
                    'religion' => $request->form['religion'],
                    'place_of_birth' => $request->form['place_of_birth'],
                    'road' => $request->form['road'],
                    'village' => $request->form['village'],
                    'subdistrict' => $request->form['subdistrict'],
                    'city' => $request->form['city'],
                    'province' => $request->form['province'],
                ]);
    
                if ($request->hasFile('form.avatar')) {
                    $path = $request->file('form.avatar')->store('public/avatars');
                    $student->user->update([
                        'avatar' => $path
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