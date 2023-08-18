<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserType extends Model
{
    protected $fillable = [];

    public $timestamps = false;

    public function user(): hasMany
    {
        return $this->hasMany(User::class);
    }
}
