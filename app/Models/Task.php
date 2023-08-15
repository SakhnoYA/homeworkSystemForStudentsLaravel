<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'type',
        'title',
        'description',
        'options',
        'answer',
        'score',
        'created_by',
        'updated_by',
        'homework_id'
    ];

    public function homework(): BelongsTo
    {
        return $this->belongsTo(Homework::class);
    }
}
