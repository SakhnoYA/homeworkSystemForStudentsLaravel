<?php

namespace App\Models;

use App\Casts\StringSquish;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $casts = [
        'options' => StringSquish::class,
        'answer' => StringSquish::class
    ];

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

    public function inputs(): HasMany
    {
        return $this->hasMany(Input::class);
    }

//    protected function options(): Attribute
//    {
//        return Attribute::make(
//            set: fn (string $value) =>  preg_replace('!\s+!', ' ', $value)
//        );
//    }
//
//    protected function answer(): Attribute
//    {
//        return Attribute::make(
//            set: fn (string $value) => preg_replace('!\s+!', ' ', $value)
//        );
//    }
}
