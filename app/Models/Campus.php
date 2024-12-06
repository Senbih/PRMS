<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campus extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'president_id'];

    public function president()
    {
        return $this->belongsTo(User::class, 'president_id');
    }

    public function offices(): HasMany
    {
        return $this->hasMany(Office::class);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }
}
