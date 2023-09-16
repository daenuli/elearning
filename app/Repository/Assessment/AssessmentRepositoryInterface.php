<?php

namespace App\Repository\Assessment;

use App\Models\Assessment;
use Illuminate\Http\Request;

interface AssessmentRepositoryInterface {
    
    /**
     * @param Illuminate\Http\Request $request
     * @return bool
     */
    public function store(Request $request): bool;

    /**
     * @param App\Models\Assesment $assesment
     * @param Illuminate\Http\Request $request
     * @param array $data
     * @return bool
     */
    public function update(Request $request, Assessment $assesment);

    /**
     * @param App\Models\Assesment $assesment
     * @return bool
     */
    public function publish(Assessment $assesment);

    /**
     * @return Collection
     */
    public function activeAssessments();
    
    /**
     * @return Response
     */
    public function pendingAssessment();

    /**
     * @param Request $request
     * @return Response
     */
    public function searchAssesments(Request $request);
}
