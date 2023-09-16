<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Question;
use Illuminate\Support\Carbon;
use App\Models\AssessmentStudent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Assessment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'assessments';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['due_date_label'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_published' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    const DRAFT = 0;
    const PUBLISHED = 1;
    const COMPLETED = 'Completed';
    const NOTSTARTED = 'Not Started';
    const INPROGRESS = 'In Progress';


    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->essay_questions()->delete();
            $model->multiple_choice_questions()->delete();
        });
    }

    /**
     * Get the teacher that owns the Assessment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Get the class that owns the Assessment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }

    /**
     * Get the study_group that owns the Assessment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function study_group(): BelongsTo
    {
        return $this->belongsTo(StudyGroup::class);
    }

    /**
     * Get the subject that owns the Assessment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class)->withDefault();
    }

    /**
     * Get all of the questions for the Assessment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function multiple_choice_questions(): HasMany
    {
        return $this->hasMany(Question::class)->where('type', 'Multiple Choice');
    }

    /**
     * Get all of the essay_questions for the Assessment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function essay_questions(): HasMany
    {
        return $this->hasMany(Question::class)->where('type', 'Essay');
    }

    /**
     * Get all of the answers for the Assessment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * The students that belong to the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class)
                ->withPivot('id', 'status', 'submitted_at', 'marks_obtained', 'is_graded', 'time_spent')
                ->using(AssessmentStudent::class)
                ->as('status');
    }

    public function isPublished()
    {
        return $this->is_published;
    }

    /**
     * @return string
     */
    public function getDueDateLabelAttribute()
    {
        return Carbon::parse($this->end_date)->toFormattedDateString();
    }
}