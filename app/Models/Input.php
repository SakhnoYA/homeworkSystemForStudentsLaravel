<?php

namespace App\Models;

use App\Casts\StringSquish;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

use function preg_replace;

class Input extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable = ['body','is_correct','attempt_id','task_id'];

    protected $casts = [
        'body' => StringSquish::class
    ];

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(Attempt::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

//    protected function body(): Attribute
//    {
//        return Attribute::make(
//            set: fn (string $value) =>  preg_replace('!\s+!', ' ', $value)
//        );
//    }
}
