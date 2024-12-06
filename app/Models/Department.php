<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'teamleader_id',
        'division_id',

    ];

    /**
     * The users that belong to the class.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * The contents that belong to the class.
     */
    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
