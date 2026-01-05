<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        Testimonial::create([
            'client_name' => 'Robert Johnson',
            'client_position' => 'CEO',
            'client_company' => 'StartupXYZ',
            'content' => 'TechCorp delivered an outstanding web application that exceeded our expectations. Their team was professional, responsive, and truly understood our business needs. Highly recommended!',
            'rating' => 5,
            'is_approved' => true,
            'is_featured' => true,
            'order' => 1,
        ]);

        Testimonial::create([
            'client_name' => 'Jennifer Lee',
            'client_position' => 'Marketing Director',
            'client_company' => 'E-Commerce Plus',
            'content' => 'The e-commerce platform they built for us has transformed our business. Sales have increased by 150% since launch. The team\'s expertise and dedication are unmatched.',
            'rating' => 5,
            'is_approved' => true,
            'is_featured' => true,
            'order' => 2,
        ]);

        Testimonial::create([
            'client_name' => 'Michael Brown',
            'client_position' => 'Product Manager',
            'client_company' => 'HealthTech Solutions',
            'content' => 'Working with TechCorp was a great experience. They delivered our mobile app on time and within budget. The quality of their work speaks for itself.',
            'rating' => 5,
            'is_approved' => true,
            'is_featured' => false,
            'order' => 3,
        ]);

        Testimonial::create([
            'client_name' => 'Amanda White',
            'client_position' => 'Founder',
            'client_company' => 'Creative Agency Co',
            'content' => 'Excellent communication throughout the project. The team was always available to answer questions and made adjustments based on our feedback. Very satisfied with the results!',
            'rating' => 4,
            'is_approved' => true,
            'is_featured' => false,
            'order' => 4,
        ]);
    }
}
