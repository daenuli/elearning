<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Student;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasRoles;
    use SoftDeletes;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->student()->delete();
        });
    }

    public function isAdmin()
    {
        return $this->role->id == config('app.roles.Admin');
    }

    public function isTeacher()
    {
        return $this->role->id == config('app.roles.Teacher');
    }

    public function isStudent()
    {
        return $this->role->id == config('app.roles.Student');
    }

    public function getRoleNameAttribute()
    {
        return $this->role->name;
    }

    public function getRoleAttribute()
    {
        return $this->roles->first();
    }

    /**
     * Get the teacher associated with the teacher
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class)->withDefault();
    }

    /**
     * Get the student associated with the student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function student(): HasOne
    {
        return $this->hasOne(Student::class)->withDefault();
    }

    public function absoluteAavatarPath()
    {
        return app()->environment() === 'local'
            ? storage_path('app/'. $this->avatar)
            : storage_path('storage/app/'. $this->avatar);
    }

    public function getAvatar()
    {
        if (app()->environment() === 'local') {
            return is_file($this->absoluteAavatarPath()) ? Storage::url($this->avatar) : false;
        }
        return asset('storage/app/'. $this->avatar);
    }
}
