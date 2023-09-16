<?php

namespace App\Repository\Assessment;

use App\Models\Student;
use App\Models\Assessment;
use Illuminate\Http\Request;
use App\Models\AssessmentStudent;

interface AssessmentEvaluationRepositoryInterface {

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function assessments();

    /**
     * @param Assessment $assessment
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(Assessment $assessment);

    /**
     * @param App\Models\AssessmentStudent $studentAssessment
     * @param Illuminate\Http\Request $request
     * @param array $data
     * @return bool
     */
    public function gradeAssessment(Request $request, AssessmentStudent $studentAssessment);

    /**
     * @param AssessmentStudent $studentAssessment
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getQuestions(AssessmentStudent $studentAssessment);
}
