<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends DatabaseNotification
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['created_at_date', 'created_at_dates', 'is_read'];

    protected function getCreatedAtDateAttribute()
    {
        return $this->created_at->toFormattedDateString();
    }

    protected function getCreatedAtDatesAttribute()
    {
        return $this->created_at->toFormattedDateString();
    }

    protected function getIsReadAttribute()
    {
        return !is_null($this->read_at);
    }
}
