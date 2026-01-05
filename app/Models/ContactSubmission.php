<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'subject', 'message',
        'read_at', 'replied_at', 'reply_message',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'replied_at' =>  'datetime',
    ];

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
    }
}
