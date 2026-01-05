<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class JobApplication extends Model
{
    protected $fillable = [
        'job_id', 'full_name', 'email', 'phone', 'cover_letter',
        'resume_path', 'tracking_code', 'status', 'notes',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($application) {
            if (empty($application->tracking_code)) {
                $application->tracking_code = strtoupper(Str::random(10));
            }
        });
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
