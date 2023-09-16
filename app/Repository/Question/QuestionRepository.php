<?php

namespace App\Repository\Question;

use App\Models\Question;
use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Teacher\QuestionIndexResource;
use App\Repository\Question\QuestionRepositoryInterface;

class QuestionRepository implements QuestionRepositoryInterface
{

    /**
     * @param Assessment $assessment
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Assessment $assessment)
    {
        return QuestionIndexResource::collection($assessment->multiple_choice_questions()->with('choices')->whereHas('choices')->get());
    }

    /**
     * @param Request $request
     * @param Assessment $assessment
     * 
     * @return bool
     */
    public function store(Request $request, Assessment $assessment): bool
    {
        try {            
            $questions = $request->questions;

            $data = [
                "questions" => []
            ];

            foreach ($questions as $question) {
                $data["questions"][] = [
                    "text" => $question['text'],
                    "file" => isset($question['file']) ? $question['file'] : '',
                    "choices" => [
                        [
                            "text" => $question['optionA'],
                            "is_correct" => $question['correctOption'] == 'optionA'
                        ],
                        [
                            "text" => $question['optionB'],
                            "is_correct" => $question['correctOption'] == 'optionB'
                        ],
                        [
                            "text" => $question['optionC'],
                            "is_correct" => $question['correctOption'] == 'optionC'
                        ],
                        [
                            "text" => $question['optionD'],
                            "is_correct" => $question['correctOption'] == 'optionD'
                        ]
                    ]
                ];
            }

            DB::beginTransaction();

            foreach($data['questions'] as $item) {
                $model = $assessment->multiple_choice_questions()->create([
                    'text' => $item['text'],
                    'type' => 'Multiple Choice'
                ]);

                foreach($item['choices'] as $choice) {
                    $model->choices()->create([
                        'text' => $choice['text'],
                        'is_correct' => $choice['is_correct'],
                    ]);
                }

                if (isset($item['file'])) {
                    $file = $item['file'];
                    if (!empty($file) && $file->isValid()) {
                        $model->addMedia($file)->usingFileName($file->hashname())->toMediaCollection('Question Image');
                    }
                }
            }
            
            DB::commit();
        } catch (\Throwable $th) {
            logError($th);
            DB::rollBack();
            return false;
        }

        return true;
    }

    /**
     * @param App\Models\Question $question
     * @param Illuminate\Http\Request $request
     * 
     * @return bool
     */
    public function update(Request $request, Question $question): bool
    {
        try {

            $question->update([
                'text' => $request->form['text'],
            ]);

            $choices = $question->choices;

            $model = [
                "text" => $request->form['text'],
                "file" => isset($request->form['file']) ? $request->form['file'] : '',
                "choices" => collect([
                    [
                        'id' => $choices[0]->id,
                        "text" => $request->form['optionA'],
                        "is_correct" => $request->form['correctOption'] == 'optionA'
                    ],
                    [
                        'id' => $choices[1]->id,
                        "text" => $request->form['optionB'],
                        "is_correct" => $request->form['correctOption'] == 'optionB'
                    ],
                    [
                        'id' => $choices[2]->id,
                        "text" => $request->form['optionC'],
                        "is_correct" => $request->form['correctOption'] == 'optionC'
                    ],
                    [
                        'id' => $choices[3]->id,
                        "text" => $request->form['optionD'],
                        "is_correct" => $request->form['correctOption'] == 'optionD'
                    ]
                ])
            ];

            $question->choices->each(function($item) {
                $item->update(['is_correct' => false]);
            });

            foreach($model['choices'] as $choice) {
                $question->choices()->where('id', $choice['id'])->update($choice);
            }

            if (isset($model['file'])) {
                $file = $model['file'];
                if (!empty($file) && $file->isValid()) {
                    $question->addMedia($file)->usingFileName($file->hashname())->toMediaCollection('Question Image');
                }
            }

            return true;
        } catch (\Throwable $th) {
            logError($th);
            return false;
            logError($th);
        }
    }
}