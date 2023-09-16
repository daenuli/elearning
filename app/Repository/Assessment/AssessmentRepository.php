<?php

namespace App\Repository\Assessment;

use App\Models\Student;
use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repository\Assessment\AssessmentRepositoryInterface;

class AssessmentRepository implements AssessmentRepositoryInterface
{
    /**
     * @return
     */
    public function index()
    {
        return Auth::user()->teacher->assessments()->with(['class', 'study_group', 'subject'])->get();
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function store(Request $request): bool
    {
        try {

            Assessment::create([
                'teacher_id'     => Auth::user()->teacher->id,
                'title'          => $request->title,
                'class_id'       => $request->class_id,
                'study_group_id' => $request->study_group_id,
                'subject_id'     => $request->subject_id,
                'start_date'  => $request->date('start_date'),
                'end_date'    => $request->date('end_date'),
                'time_limit_in_minutes' => $request->time_limit_in_minutes,
            ]);

            return true;
        } catch (\Throwable $th) {
            logError($th);
            return false;
        }
    }

    /**
     * @param App\Models\Assesment $assesment
     * @return bool
     */
    public function publish(Assessment $assessment)
    {
        DB::beginTransaction();
        try {
            $assessment->update(['is_published' => Assessment::PUBLISHED]);

            $students = Student::where('class_id', $assessment->class_id)->where('study_group_id', $assessment->study_group_id)->get();

            foreach ($students as $student) {
                $student->assessments()->attach($assessment->id, ['status' => Assessment::NOTSTARTED]);
            }

            DB::commit();

            return true;

        } catch (\Throwable $th) {
            DB::rollback();
            logError($th);
            return false;
        }
    }

    /**
     * @param Request $request
     * @param Assessment $assessment
     *
     * @return [type]
     */
    public function update(Request $request, Assessment $assessment)
    {
        try {

            $assessment->update([
                'teacher_id'     => Auth::user()->teacher->id,
                'title'          => $request->form['title'],
                'class_id'       => $request->form['class_id'],
                'study_group_id' => $request->form['study_group_id'],
                'subject_id'     => $request->form['subject_id'],
                'start_date'  => $request->date('form.start_date'),
                'end_date'    => $request->date('form.end_date'),
                'time_limit_in_minutes' => $request->form['time_limit_in_minutes'],
            ]);
            return true;
        } catch (\Throwable $th) {
            logError($th);
            return false;
        }
    }

    /**
     * @return Collection
     */
    public function activeAssessments()
    {
        $student = auth()->user()->student;
        return $student->assessments()
            ->with('subject')
            ->whereDate('end_date', '>=', now())
            ->whereHas('multiple_choice_questions')
            ->whereHas('essay_questions')
            ->get()->map(function ($assessment) {
                $assessment->status = $assessment->status->status;
                return $assessment;
            });
    }

    /**
     * Get all the non-submitted assessments by student
     */
    public function pendingAssessment()
    {
        $student = auth()->user()->student;
        return $student->assessments()
        ->whereDate('end_date', '>=', now())
        ->get()->map(function ($assessment) {
            if ($assessment->status->status === Assessment::NOTSTARTED) {
                return $assessment;
            };
        })->filter()->values();
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function searchAssesments(Request $request)
    {
        $student = auth()->user()->student;
        return $student->assessments()
            ->with('subject')
            ->where('subject_id', $request->subject_id)
            ->whereDate('end_date', '>=', now())
            ->whereHas('multiple_choice_questions')
            ->whereHas('essay_questions')
            ->get()->map(function ($assessment) {
                $assessment->status = $assessment->status->status;
                return $assessment;
            });
    }
}
