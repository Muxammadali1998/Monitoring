<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'worker_id',
        'status',
        'date'
    ];
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}
