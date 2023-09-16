<?php

namespace App\Models;

use App\Models\LessonDiscussionMessage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class LessonStudent extends Pivot
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lesson_student';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'access_date' => 'date',
        'deleted_at' => 'datetime',
    ];

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->discussion_messages()->delete();
        });
    }

    /**
     * The roles that belong to the LessonStudent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'lesson_student')->withPivot(['id', 'video_progress'])->using(LessonStudent::class);
    }

    /**
     * Get all of the discussion_messages for the LessonStudent
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */    
    public function discussion_messages(): HasMany
    {
        return $this->hasMany(LessonDiscussionMessage::class, 'lesson_student_id');
    }

    /**
     * Get the student that owns the LessonStudent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}