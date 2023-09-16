<?php

namespace App\Http\Controllers\Teacher;

use Inertia\Inertia;
use App\Models\Subject;
use App\Models\Assessment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssessmentRequest;
use App\Http\Requests\UpdateAssessmentRequest;
use App\Http\Resources\Teacher\AssessmentResource;
use App\Repository\Assessment\AssessmentRepositoryInterface;
use App\Repository\StudyGroup\StudyGroupRepositoryInterface;
use App\Repository\SchoolClass\SchoolClassRepositoryInterface;

class AssessmentController extends Controller
{
    /**
     * StudentController constructor
     * @param App\Repository\Assessment\AssessmentRepositoryInterface $repository
     */
    public function __construct(private AssessmentRepositoryInterface $repository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Teacher/Assessments/Index', [
            'assessments' => $this->repository->index()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Teacher/Assessments/Create', [
            'subjects' => Subject::all(),
            'classes' => app(SchoolClassRepositoryInterface::class)->index(),
            'study_groups' => app(StudyGroupRepositoryInterface::class)->index(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssessmentRequest $request)
    {
        $result = $this->repository->store($request);

        if ($result) {
            return redirect()->route('teacher.assessments.index')->with('success', 'Assessment created successfully.');
        }

        return redirect()->route('teacher.assessments.index')->with('error', serverErrorMessage());
    }

    /**
     * @param Assessment $assessment
     * 
     * @return \Illuminate\Http\Response
     */
    public function publish(Assessment $assessment)
    {
        // if (
        //     $assessment->essay_questions->isEmpty() || 
        //     $assessment->multiple_choice_questions->isEmpty()) {
        // } {
        //     return redirect()->route('teacher.assessments.index')->with('warning', 'Please include multiple-choice and essay questions in the assessment before publishing, as there are currently none.');
        // }

        $result = $this->repository->publish($assessment);

        if ($result) {
            return redirect()->route('teacher.assessments.index')->with('success', 'Assessment published successfully.');
        }

        return redirect()->route('teacher.assessments.index')->with('error', serverErrorMessage());
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Assessment $assessment
     * @return \Illuminate\Http\Response
     */
    public function show(Assessment $assessment)
    {
        return Inertia::render('Teacher/Assessments/Show', [
            'assessment' => new AssessmentResource($assessment->load(['class', 'study_group', 'subject', 'multiple_choice_questions', 'essay_questions']))
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Assessment $assessment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assessment $assessment)
    {
        if ($assessment->isPublished()) {
            return redirect()->route('teacher.assessments.index')->with('warning', 'You cannot update the assessment once it has been published.');
        }

        return Inertia::render('Teacher/Assessments/Edit', [
            'assessment' => $assessment,
            'subjects' => Subject::all(),
            'classes' => app(SchoolClassRepositoryInterface::class)->index(),
            'study_groups' => app(StudyGroupRepositoryInterface::class)->index(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Assessment $assessment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssessmentRequest $request, Assessment $assessment)
    {
        $result = $this->repository->update($request, $assessment);

        if ($result) {
            return redirect()->route('teacher.assessments.show', $assessment)->with('success', 'Assessment updated successfully.');
        }

        return redirect()->route('teacher.assessments.index')->with('error', serverErrorMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Assessment $assessment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assessment $assessment)
    {
        if ($assessment->isPublished()) {
            return redirect()->route('teacher.assessments.index')->with('warning', 'You cannot delete the assessment once it has been published.');
        }

        $assessment->delete();
        return redirect()->route('teacher.assessments.index')->with('success', 'Assessment deleted successfully.');
    }
}
