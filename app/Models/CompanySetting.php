<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $fillable = [
        'company_name',
        'company_logo',
        'company_description',
        'about_us',
        'vision',
        'mission',
        'email',
        'phone',
        'phone_secondary',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'business_hours',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'youtube_url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'google_analytics_id',
    ];

    protected $casts = [
        'business_hours' => 'array',
    ];

    /**
     * Get the singleton instance of company settings
     */
    public static function getSetting(): ?self
    {
        return self::first();
    }

    /**
     * Update or create the singleton company settings
     */
    public static function updateSettings(array $data): self
    {
        $setting = self::first();
        
        if ($setting) {
            $setting->update($data);
            return $setting;
        }
        
        return self::create($data);
    }
}
