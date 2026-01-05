<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        Slider::create([
            'title' => 'Transform Your Business with Technology',
            'subtitle' => 'We build innovative web and mobile solutions that drive growth',
            'button_text' => 'Get Started',
            'link_url' => '/services',
            'is_active' => true,
            'order' => 1,
        ]);

        Slider::create([
            'title' => 'Expert Development Team',
            'subtitle' => 'Over 10 years of experience delivering excellence',
            'button_text' => 'View Portfolio',
            'link_url' => '/portfolio',
            'is_active' => true,
            'order' => 2,
        ]);

        Slider::create([
            'title' => 'Custom Solutions for Every Need',
            'subtitle' => 'From startups to enterprises, we have you covered',
            'button_text' => 'Contact Us',
            'link_url' => '/contact',
            'is_active' => true,
            'order' => 3,
        ]);
    }
}
