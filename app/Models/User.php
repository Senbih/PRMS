<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'dept_id',
        'division_id',
        'office_id',
        'campus_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * The classes that the user belongs to.
     */

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }

    /**
     * The contents created by the teacher.
     */
    public function contents(): HasMany
    {
        return $this->hasMany(Content::class, 'teamleader_id');
    }
    public function divisions(): HasMany
    {
        return $this->hasMany(Division::class, 'director_id');
    }

    public function offices(): HasMany
    {
        return $this->hasMany(Office::class, 'vice_president_id');
    }

    public function campuses(): HasMany
    {
        return $this->hasMany(Campus::class, 'president_id');
    }
}
