<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignmentStudent extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'assignment_student';

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
        'is_completed' => 'bool',
        'is_graded' => 'bool',
        'submitted_at' => 'date',
        'deleted_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['submitted_at_date', 'filePathLabel'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the student that owns the AssignmentStudent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * @return string
     */
    public function getSubmittedAtDateAttribute()
    {
        return $this->submitted_at?->toFormattedDateString();
    }

    public function absoluteFilePath()
    {
        return storage_path('app/'. $this->file_path);
    }

    /**
     * @return string
     */
    public function getFilePathLabelAttribute()
    {
        if (file_exists($this->absoluteFilePath())) {
            if (app()->environment() === 'local') {
                return asset('storage'. str_replace('public', '', $this->file_path));
            }
    
            if (app()->environment() === 'production') {
                return asset('storage/app/'. $this->file_path);
            }
        }
    }
}
