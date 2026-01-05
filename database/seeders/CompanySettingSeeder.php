<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use Illuminate\Database\Seeder;

class CompanySettingSeeder extends Seeder
{
    public function run(): void
    {
        CompanySetting::create([
            'company_name' => 'TechCorp Solutions',
            'tagline' => 'Innovating Tomorrow, Today',
            'description' => 'We are a leading technology company specializing in web development, mobile applications, and digital transformation solutions. With over 10 years of experience, we help businesses succeed in the digital age.',
            'email' => 'info@techcorp.com',
            'phone' => '+1 (555) 123-4567',
            'address' => '123 Tech Street, Silicon Valley, CA 94025',
            'facebook_url' => 'https://facebook.com/techcorp',
            'twitter_url' => 'https://twitter.com/techcorp',
            'instagram_url' => 'https://instagram.com/techcorp',
            'linkedin_url' => 'https://linkedin.com/company/techcorp',
            'meta_title' => 'TechCorp Solutions - Professional Web Development & Digital Solutions',
            'meta_description' => 'Leading technology company providing web development, mobile apps, and digital transformation services.',
            'meta_keywords' => 'web development, mobile apps, digital solutions, technology consulting',
        ]);
    }
}
