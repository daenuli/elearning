<?php

namespace App\Models;

use App\Models\Teacher;
use App\Models\Assignment;
use App\Models\StudyGroup;
use App\Models\SchoolClass;
use App\Models\Notification;
use App\Models\LessonStudent;
use App\Models\AssessmentStudent;
use App\Models\AssignmentStudent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\DatabaseNotification;

class Student extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'students';

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
        'date_of_birth' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * The channels the user receives notification broadcasts on.
     */
    public function receivesBroadcastNotificationsOn(): string
    {
        return 'private-class.'.$this->class_id;
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');
    }

    /**
     * Get all of the pivots for the Lesson
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pivots(): HasMany
    {
        return $this->hasMany(LessonStudent::class);
    }

    /**
     * Get the user that owns the Teacher
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the teacher that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    /**
     * Get the study_group that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function study_group(): BelongsTo
    {
        return $this->belongsTo(StudyGroup::class)->withDefault();
    }

    /**
     * Get the school_class that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school_class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id')->withDefault();
    }

    /**
     * The lessons that belong to the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class)->withPivot(['id', 'video_progress'])->using(LessonStudent::class);
    }

    /**
     * @param Lesson $lesson
     * 
     * @return [type]
     */
    public function getLessonVideoCompletionPercentage(Lesson $lesson)
    {
        return $this->lessons()->where('lesson_id', $lesson->id)->first()?->pivot;
    }

    /**
     * The assessments that belong to the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function assessments(): BelongsToMany
    {
        return $this->belongsToMany(Assessment::class)->withPivot('id', 'status', 'submitted_at', 'marks_obtained', 'is_graded', 'time_spent')
        ->using(AssessmentStudent::class)
        ->as('status');
    }

    /**
     * The assignments that belong to the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function assignments(): BelongsToMany
    {
        return $this->belongsToMany(Assignment::class)->withPivot('id', 'is_completed', 'submitted_at', 'marks_obtained', 'file_path', 'is_graded')
        ->using(AssignmentStudent::class)
        ->as('status');
    }

    /**
     * @param Assessment $assessment
     * 
     * @return [type]
     */
    public function statusOfAssessment(Assessment $assessment)
    {
        return $this->assessments()->where('assessment_id', $assessment->id)->first()->status;
    }
}