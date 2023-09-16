<?php

namespace App\Traits\Students;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToStudent {

    protected static function booted()
    {
        static::creating(function($model) {
            $model->student_id = Auth::user()->student->id;
        });
    }

    /**
     * Get the student that owns the BelongsToStudent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }


}