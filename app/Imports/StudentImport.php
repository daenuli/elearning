<?php

namespace App\Imports;

use App\Models\User;
use App\Models\StudyGroup;
use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentImport implements ToCollection, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        try {

            foreach ($rows as $row) {
                
                $date_of_birth = now();

                if (!is_numeric($row['date_of_birth'])) {
                    $date_of_birth = Carbon::parse($row['date_of_birth']);
                } else {
                    $date_of_birth = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth']));
                }

                if ($row['delete_student'] === 'Yes') {
                    $email = $row['email'];
                    User::whereEmail($email)->delete();
                    Student::whereEmail($email)->delete();
                } else {
                    $class = SchoolClass::whereName($row['class'])->first();
                    $study_group = StudyGroup::whereName($row['study_group'])->first();
                    
                    $user =  User::updateOrCreate(['email' => $row['email']],[
                        'name'  => $row['name'],
                        'password' => Hash::make('password')
                    ]);
    
                    $user->assignRole('Student');
    
                    $user->student()->updateOrCreate(['email' => $row['email']], [
                        'name' => $row['name'],
                        'NISN_number' => $row['nisn'],
                        'place_of_birth' => $row['place_of_birth'],
                        'gender' => $row['gender'],
                        'religion' => $row['religion'],
                        'date_of_birth' => $date_of_birth,
                        'class_id' => $class->id,
                        'study_group_id' => $study_group->id,
                    ]);
                }
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            logError($e);
            dd($e);
            return false;
        }

    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255'],
            'nisn' => 'required',
            'gender' => ['required', Rule::in('Male', 'Female')],
            'class' => 'required|exists:school_classes,name',
            'study_group' => 'required|exists:study_groups,name',
            'religion' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'delete_student' => ['nullable', Rule::in('Yes', 'No')],
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            'class.exists' => 'The class name is invalid.',
            'study_group.exists' => 'The study group name is invalid.',
        ];
    }
}
