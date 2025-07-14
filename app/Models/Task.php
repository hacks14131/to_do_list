<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'taskOwner',
        'title',
        'description',
        'status',
        'deadlineDate',
        'dateCompleted',
        'priority',
    ];
    public function scopePriority($query) {
        return $query->where('priority', true);
    }
}
