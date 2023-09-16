<?php

namespace App\Http\Controllers\Teacher;

use Inertia\Inertia;
use App\Models\Question;
use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Resources\Teacher\QuestionIndexResource;
use App\Repository\Question\QuestionRepositoryInterface;

class AssessmentQuestionController extends Controller
{
    /**
     * AssessmentQuestionController constructor
     * @param App\Repository\Question\QuestionRepositoryInterface $repository
     */
    public function __construct(private QuestionRepositoryInterface $repository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param Assessment $assessment
     * @return \Illuminate\Http\Response
     */
    public function index(Assessment $assessment)
    {
        return Inertia::render('Teacher/Questions/Index', [
            'assessment' => $assessment,
            'questions' => $this->repository->index($assessment)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param Assessment $assessment
     * @return \Illuminate\Http\Response
     */
    public function create(Assessment $assessment)
    {
        return Inertia::render('Teacher/Questions/Create', [
            'assessment' => $assessment,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request, Assessment $assessment)
    {
        $result = $this->repository->store($request, $assessment);

        if ($result) {
            return redirect()->route('teacher.assessments.show', $assessment)->with('success', 'Questions created successfully.');
        }

        return redirect()->route('teacher.assessments.show', $assessment)->with('error', serverErrorMessage());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return Inertia::render('Teacher/Questions/Edit', [
            'question' => new QuestionIndexResource($question->load('choices')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $result = $this->repository->update($request, $question);

        if ($result) {
            return redirect()->route('teacher.assessments.show', $question->assessment)->with('success', 'Question updated successfully.');
        }

        return redirect()->route('teacher.assessments.show', $question->assessment)->with('error', serverErrorMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->back()->with('success', 'Question deleted successfully.');
    }
}
