<?php

namespace App\Models;

use App\Models\Subject;
use App\Models\Teacher;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lesson extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lessons';

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
    protected $appends = ['youtube_video_link'];

    /**
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('Lesson Files');
    }

    /**
     * Get the teacher that owns the Lesson
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Get the class that owns the Lesson
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }

    /**
     * Get the study_group that owns the Lesson
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function study_group(): BelongsTo
    {
        return $this->belongsTo(StudyGroup::class);
    }

    /**
     * Get the subject that owns the Lesson
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class)->withDefault();
    }

    /**
     * @return array
     */
    public function getFiles(): array
    {
        return $this->getMedia('Lesson Files')->map(function ($media) {
            if (file_exists($media->getPath())) {
                if (app()->environment() === 'local') {
                    return [
                        'url' => $media->getUrl(),
                        'name' => $media->file_name,
                        'mime_type' => $media->mime_type
                    ];
                }

                if (app()->environment() === 'production') {
                    $path = explode('storage', $media->getUrl());
                    if (isset($path[1])) {
                        return [
                            'url' => asset('storage/app/public' . $path[1]),
                            'name' => $media->file_name,
                            'mime_type' => $media->mime_type
                        ];
                    }
                }
            }
        })->filter(fn ($item) => !is_null($item))->toArray();
    }

    /**
     * @return string
     */
    public function getYoutubeVideoLinkAttribute()
    {
        $string = explode('https://www.youtube.com/watch?v=', $this->youtube_link);
        if (is_array($string) && isset($string[1])) {
            return "https://www.youtube.com/embed/" . $string[1];
        }
    }

    /**
     * The students that belong to the Lesson
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class)->withPivot(['video_progress'])->using(LessonStudent::class);
    }
}
