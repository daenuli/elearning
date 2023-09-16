<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subjects';

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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

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
     * Get the assignment associated with the Subject
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function assignment(): HasOne
    {
        return $this->hasOne(Assignment::class);
    }

    /**
     * Get the lesson associated with the Subject
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lesson(): HasOne
    {
        return $this->hasOne(Lesson::class);
    }
}