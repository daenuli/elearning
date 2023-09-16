<?php

namespace App\Models;

use App\Models\SchoolClass;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'books';

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
    protected $appends = ['file_path'];

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
     * Get the subject that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class)->withDefault();
    }

    /**
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('Book File');
    }

    /**
     * Get the school_class that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school_class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function getFilePathAttribute()
    {
        $media = $this->getFirstMedia('Book File');
        if ($media && file_exists($media->getPath())) {
            if (app()->environment() === 'local') {
                return $media->getUrl();
            }
    
            if (app()->environment() === 'production') {
                $path = explode('storage', $media->getUrl());
                if (isset($path[1])) {
                    return asset('storage/app/public' . $path[1]);
                }
            }
        }
    }
}
