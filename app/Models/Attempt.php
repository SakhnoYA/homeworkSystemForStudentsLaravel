<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attempt extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
        'homework_id'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function homework(): BelongsTo
    {
        return $this->belongsTo(Homework::class);
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function inputs(): HasMany
    {
        return $this->hasMany(Input::class);
    }
}
