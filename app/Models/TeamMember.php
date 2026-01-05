<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name', 'role', 'department', 'bio', 'photo', 'email',
        'phone', 'social_links', 'order',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];
}
