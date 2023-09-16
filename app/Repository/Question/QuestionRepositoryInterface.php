<?php

namespace App\Repository\Question;

use App\Models\Assessment;
use Illuminate\Http\Request;

interface QuestionRepositoryInterface {
    
    /**
     * @param Assessment $assessment
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Assessment $assessment);

    /**
     * @param Request $request
     * @param Assessment $assessment
     * 
     * @return bool
     */
    public function store(Request $request, Assessment $assessment): bool;

    // /**
    //  * @param App\Models\Question $question
    //  * @param Illuminate\Http\Request $request
    //  * 
    //  * @return bool
    //  */
    // public function update(Request $request, Question $question): bool;
}