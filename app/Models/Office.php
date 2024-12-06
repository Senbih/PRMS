<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Office extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'vice_president_id', 'campus_id'];

    public function vicePresident(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vice_president_id');
    }

    public function campus(): BelongsTo
    {
        return $this->belongsTo(Campus::class);
    }

    public function divisions(): HasMany
    {
        return $this->hasMany(Division::class);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }
}
