<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic',
        'title',
        'description',
        'video',
        'document',
        'external_link',
        'department_id',
        'division_id',
        'office_id',
        'campus_id',
        'teamleader_id',
        'staff_id',
        'approval_status',
        'type',
    ];

    // Relationship with Department
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    // Relationship with User (as Team Leader)
    public function teamleader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teamleader_id');
    }

    // New relationship with User (as Staff)
    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    // New relationship with Comment
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }
    public function campus(): BelongsTo
    {
        return $this->belongsTo(Campus::class);
    }
}
