<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function homeworks(): HasMany
    {
        return $this->hasMany(Homework::class);
    }
}
