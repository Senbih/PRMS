<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'director_id', 'office_id'];

    public function director(): BelongsTo
    {
        return $this->belongsTo(User::class, 'director_id');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }
}
