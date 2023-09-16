<?php

namespace App\Repository\Assignment;

use App\Models\Student;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewAssignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Repository\Assignment\AssignmentRepositoryInterface;

class AssignmentRepository implements AssignmentRepositoryInterface
{
    /**
     * @return 
     */
    public function index()
    {
        return Auth::user()->teacher->assignments()->with(['class', 'study_group', 'subject'])->get();
    }

    /**
     * @param Request $request
     * 
     * @return bool
     */
    public function store(Request $request): bool
    {
        try {

            $assignment = Assignment::create([
                'teacher_id'     => Auth::user()->teacher->id,
                'title'          => $request->title,
                'class_id'       => $request->class_id,
                'study_group_id' => $request->study_group_id,
                'subject_id'     => $request->subject_id,
                'instructions'    => $request->instructions,
                'start_date'  => $request->date('start_date'),
                'end_date'    => $request->date('end_date'),
            ]);

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $fileName = 'Assignment_' . $assignment->title . '.' . $file->extension();
                    $assignment->addMedia($file)->usingFileName($fileName)->toMediaCollection('Assignment Files');
                }
            }
            return true;
        } catch (\Throwable $th) {
            logError($th);
            dd($th);
            return false;
        }
    }

    /**
     * @param Request $request
     * @param Assignment $assignment
     * 
     * @return [type]
     */
    public function update(Request $request, Assignment $assignment)
    {
        try {

            $assignment->update([
                'teacher_id'     => Auth::user()->teacher->id,
                'title'          => $request->form['title'],
                'class_id'       => $request->form['class_id'],
                'study_group_id' => $request->form['study_group_id'],
                'subject_id'     => $request->form['subject_id'],
                'instructions'    => $request->form['instructions'],
                'start_date'  => $request->date('form.start_date'),
                'end_date'    => $request->date('form.end_date'),
            ]);

            if ($request->hasFile('form.files')) {
                foreach ($request->file('form.files') as $file) {
                    $fileName = 'Assignment_' . $assignment->title . '.' . $file->extension();
                    $assignment->addMedia($file)->usingFileName($fileName)->toMediaCollection('Assignment Files');
                }
            }

            return true;
        } catch (\Throwable $th) {
            logError($th);
            return false;
        }
    }

    public function publish(Assignment $assignment)
    {
        DB::beginTransaction();
        
        try {
            $assignment->update(['is_published' => Assignment::PUBLISHED]);
            
            $students = Student::where('class_id', $assignment->class_id)
                ->where('study_group_id', $assignment->study_group_id)
                ->get();

            foreach ($students as $student) {
                $student->assignments()->attach($assignment->id, ['is_completed' => false]);
            }
            
            Notification::send($students, new NewAssignment($assignment));
            
            DB::commit();

            return true;
        } catch (\Throwable $th) {
            DB::rollback();
            logError($th);
            return false;
        }
    }

    /**
     * @return [type]   
     */
    public function activeAssignments()
    {
        $student = auth()->user()->student;
        return $student->assignments()
            ->with('subject')
            ->whereDate('end_date', '>=', now())
            ->get()->map(function ($assignment) {
                $assignment->is_completed = $assignment->status->is_completed;
                return $assignment;
            });
    }

    /**
     * Get all the non-submitted assignments by student
     */
    public function pendingAssignments()
    {
        $student = auth()->user()->student;
        return $student->assignments()
            ->with('subject')
            ->whereDate('end_date', '>=', now())
            ->get()->map(function ($assignment) {
                if (!$assignment->status->is_completed) {
                    return $assignment;
                };
            })->filter()->values();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function searchAssignments(Request $request)
    {
        $student = auth()->user()->student;
        return $student->assignments()
        ->with('subject')
        ->where('subject_id',  $request->subject_id)
        ->whereDate('end_date', '>=', now())
        ->get()->map(function ($assignment) {
            $assignment->is_completed = $assignment->status->is_completed;
            return $assignment;
        });
    }
}
