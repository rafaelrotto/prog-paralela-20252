<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'licensed',
        'responsible_id'
    ];

    public function responsible()
    {
        return $this->belongsTo(User::class, 'responsible_id', 'id');
    }
}
