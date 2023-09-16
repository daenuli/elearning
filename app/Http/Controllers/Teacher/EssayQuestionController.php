<?php

namespace App\Http\Controllers\Teacher;

use Inertia\Inertia;
use App\Models\Question;
use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\StoreEssayQuestionRequest;
use App\Http\Requests\UpdateEssayQuestionRequest;
use App\Http\Resources\Teacher\QuestionIndexResource;
use App\Repository\Question\QuestionRepositoryInterface;

class EssayQuestionController extends Controller
{
    /**
     * EssayQuestionController constructor
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
        $questions = QuestionIndexResource::collection($assessment->essay_questions()->get());
        return Inertia::render('Teacher/EssayQuestions/Index', [
            'assessment' => $assessment,
            'questions' => $questions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param Assessment $assessment
     * @return \Illuminate\Http\Response
     */
    public function create(Assessment $assessment)
    {
        return Inertia::render('Teacher/EssayQuestions/Create', [
            'assessment' => $assessment,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreEssayQuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEssayQuestionRequest $request, Assessment $assessment)
    {
        $request->validate([
            'questions.*.text' => 'required'
        ]);

        foreach($request->questions as $essay_question) {
            $model = $assessment->essay_questions()->create([
                'text' => $essay_question['text'],
                'type' => 'Essay',
            ]);

            if (isset($essay_question['file'])) {
                $file = $essay_question['file'];
                if (!empty($file) && $file->isValid()) {
                    $model->addMedia($file)->usingFileName($file->hashname())->toMediaCollection('Question Image');
                }
            }
        }

        return redirect()->route('teacher.assessments.show', $assessment)->with('success', 'Questions created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $essay_question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $essay_question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $essay_question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $essay_question)
    {
        return Inertia::render('Teacher/EssayQuestions/Edit', [
            'question' => new QuestionIndexResource($essay_question),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $essay_question
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEssayQuestionRequest $request, Question $essay_question)
    {
        $essay_question->update([
            'text' => $request->form['text']
        ]);
        
        $file = $request->form['file'];
        if (!is_null($file) && $file->isValid()) {
            $essay_question->addMedia($file)->usingFileName($file->hashname())->toMediaCollection('Question Image');
        }

        return redirect()->route('teacher.assessments.show', $essay_question->assessment)->with('success', 'Question updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $essay_question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $essay_question)
    {
        $essay_question->delete();

        return redirect()->back()->with('success', 'Question deleted successfully.');
    }
}
