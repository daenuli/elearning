<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Teacher;
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

class TeachersImport implements ToCollection, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    public function collection(Collection $rows)
    {
        DB::beginTransaction();
        try {
            foreach ($rows as $row) {

                $tmt_date = now();

                if (!is_numeric($row['tmt_date'])) {
                    $tmt_date = Carbon::parse($row['tmt_date']);
                } else {
                    $tmt_date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tmt_date']));
                }

                if ($row['delete_teacher'] === 'Yes') {
                    $email = $row['email'];
                    User::whereEmail($email)->delete();
                    Teacher::whereEmail($email)->delete();
                } else {
                    $user =  User::updateOrCreate(['email' => $row['email']],[
                        'name'  => $row['name'],
                        'password' => Hash::make('password')
                    ]);
    
                    $user->assignRole('Teacher');
                    $user->teacher()->updateOrCreate(['email' => $row['email']], [
                        'name' => $row['name'],
                        'education' => $row['education'],
                        'gender' => $row['gender'],
                        'religion' => $row['religion'],
                        'appointment_decree' => $row['appointment_decree'],
                        'date' => $tmt_date,
                    ]);
                }
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            $env = config('app.env');
            Log::error("*Error:* `{$e->getMessage()}` \n *File:* {$e->getFile()} at line {$e->getLine()}. \n *Environment:* {$env}");
            return false;
        }

    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255'],
            'education' => 'required',
            'gender' => ['required', Rule::in('Male', 'Female')],
            'religion' => 'required',
            'appointment_decree' => 'required',
            'tmt_date' => 'required',
        ];
    }
}
