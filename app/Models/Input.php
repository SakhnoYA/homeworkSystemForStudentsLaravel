<?php

namespace App\Models;

use App\Casts\StringSquish;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Input extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = ['body', 'is_correct', 'attempt_id', 'task_id'];

    protected $casts = [
        'body' => StringSquish::class,
    ];

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(Attempt::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
