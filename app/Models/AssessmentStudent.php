<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssessmentStudent extends Pivot
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'assessment_student';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['submittedAtDate'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'submitted_at' => 'date',
        'is_completed' => 'boolean',
        'deleted_at' => 'datetime',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return string
     */
    public function getSubmittedAtDateAttribute()
    {
        return $this->submitted_at?->toFormattedDateString();
    }

    public function isCompleted()
    {
        return $this->is_completed;
    }
}
