<?php

namespace App\Repository\Assignment;

use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Repository\Assignment\AssignmentEvaluationRepositoryInterface;

class AssignmentEvaluationRepository implements AssignmentEvaluationRepositoryInterface
{
    /**
     * @param Assignment $assignment
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(Assignment $assignment)
    {
        return $assignment->students()
            ->withPivot('file_path')
            ->get();
    }

    /**
     * @param Request $request
     * 
     * @return bool
     */
    public function store(Request $request, Assignment $assignment): bool
    {
        try {

            return true;
        } catch (\Throwable $th) {
            logError($th);
            return false;
        }
    }
}
