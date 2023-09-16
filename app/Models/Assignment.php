<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\AssignmentStudent;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Assignment extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'assignments';

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
        'is_expired' => 'boolean',
        'start_date', 'date',
        'end_date', 'date',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['due_date_label'];

    const DRAFT = 0;
    const PUBLISHED = 1;

    /**
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('Assignment Files');
    }

    /**
     * Get the teacher that owns the Assignment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Get the class that owns the Assignment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }

    /**
     * Get the study_group that owns the Assignment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function study_group(): BelongsTo
    {
        return $this->belongsTo(StudyGroup::class);
    }

    /**
     * Get the subject that owns the Assignment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class)->withDefault();
    }

    /**
     * The students that belong to the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class)->withPivot('id', 'is_completed', 'submitted_at', 'marks_obtained', 'file_path', 'is_graded')
        ->using(AssignmentStudent::class)
        ->as('status');
    }

    /**
     * @return array
     */
    public function getFiles(): array
    {
        return $this->getMedia('Assignment Files')->map(function($media) {
            if (file_exists($media->getPath())) {
                $url = app()->environment() === 'local' ? $media->getUrl() : asset('storage/app/public'.explode('storage', $media->getUrl())[1]);

                return [
                    'url' => $url,
                    'name' => $media->file_name,
                    'mime_type' => $media->mime_type
                ];
            }
        })->filter(fn ($item) => !is_null($item))->toArray();
    }

    /**
     * @param string $path
     * @return string
     */
    public function absFilePath(string $path): string
	{
        return storage_path('app/public/assignments/'.$path);
	}

    public function isPublished()
    {
        return $this->is_published;
    }

    /**
     * @param  string  $value
     * @return string
     */
    public function getDueDateLabelAttribute($value)
    {
        return Carbon::parse($this->end_date)->toFormattedDateString();
    }
}