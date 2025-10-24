<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quiz extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'discipline_id'
    ];

    public function discipline(): BelongsTo
    {
        return $this->belongsTo(Discipline::class);
    }
}
