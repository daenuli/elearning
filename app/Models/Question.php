<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Choice;
use App\Models\Assessment;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'assessment_id', 'text', 'type', 'deleted_at'];

    /**
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('Question Image')->singleFile();
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->choices()->delete();
        });
    }

    /**
     * Get all of the choices for the Question
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function choices(): HasMany
    {
        return $this->hasMany(Choice::class);
    }

    /**
     * Get the answer associated with the Question
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function answer(): HasOne
    {
        return $this->hasOne(Answer::class)->withDefault();
    }

    /**
     * @return Attribute
     */
    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => Carbon::parse($value)->diffForHumans(),
        );
    }

    /**
     * Get the assessment that owns the Question
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }   

    /**
     * @return [type]
     */
    public function getMediaModel()
    {
        return $this->getFirstMedia('Question Image');
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        $media = $this->getMediaModel();
        if (!is_null($media) && file_exists($media->getPath())) {
            $url = app()->environment() === 'local' ? $media->getUrl() : asset('storage/app/public'.explode('storage', $media->getUrl())[1]);
        
            return [
                'url' => $url,
                'name' => $media->file_name,
                'mime_type' => $media->mime_type
            ];
        } 
    }

    public function correctOption()
    {
        return $this->choices->where('is_correct', 1)->first()?->text;
    }
}
