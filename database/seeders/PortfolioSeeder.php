<?php

namespace Database\Seeders;

use App\Models\PortfolioCategory;
use App\Models\Portfolio;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // Create Categories
        $webProjects = PortfolioCategory::create([
            'name' => 'Web Applications',
            'slug' => 'web-applications',
            'description' => 'Custom web application projects',
        ]);

        $mobileProjects = PortfolioCategory::create([
            'name' => 'Mobile Apps',
            'slug' => 'mobile-apps',
            'description' => 'iOS and Android applications',
        ]);

        $ecommerce = PortfolioCategory::create([
            'name' => 'E-Commerce',
            'slug' => 'e-commerce',
            'description' => 'Online store projects',
        ]);

        // Create Portfolios
        Portfolio::create([
            'portfolio_category_id' => $webProjects->id,
            'title' => 'Enterprise CRM System',
            'slug' => 'enterprise-crm-system',
            'client_name' => 'John Smith',
            'client_company' => 'Global Solutions Inc.',
            'description' => 'Developed a comprehensive CRM system to manage customer relationships, sales pipeline, and business analytics. The platform handles over 100,000 customer records with real-time reporting and advanced search capabilities.',
            'project_date' => '2024-03-15',
            'project_url' => 'https://crm-demo.example.com',
            'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Redis', 'Docker'],
            'is_featured' => true,
            'order' => 1,
        ]);

        Portfolio::create([
            'portfolio_category_id' => $ecommerce->id,
            'title' => 'Fashion E-Commerce Platform',
            'slug' => 'fashion-ecommerce-platform',
            'client_name' => 'Sarah Johnson',
            'client_company' => 'FashionHub',
            'description' => 'Built a modern e-commerce platform with advanced product filtering, wishlist functionality, secure payment processing, and inventory management. Integrated with multiple payment gateways and shipping providers.',
            'project_date' => '2024-01-20',
            'project_url' => 'https://fashionhub.example.com',
            'technologies' => ['Laravel', 'React', 'Stripe', 'AWS S3', 'ElasticSearch'],
            'is_featured' => true,
            'order' => 2,
        ]);

        Portfolio::create([
            'portfolio_category_id' => $mobileProjects->id,
            'title' => 'Fitness Tracking Mobile App',
            'slug' => 'fitness-tracking-mobile-app',
            'client_name' => 'Mike Davis',
            'client_company' => 'FitLife',
            'description' => 'Created a cross-platform mobile application for fitness tracking with workout logging, nutrition planning, progress analytics, and social features. Integrated with wearable devices and health APIs.',
            'project_date' => '2023-11-10',
            'technologies' => ['React Native', 'Node.js', 'MongoDB', 'Firebase'],
            'is_featured' => true,
            'order' => 3,
        ]);

        Portfolio::create([
            'portfolio_category_id' => $webProjects->id,
            'title' => 'Learning Management System',
            'slug' => 'learning-management-system',
            'client_name' => 'Emily Wilson',
            'client_company' => 'EduTech Academy',
            'description' => 'Developed an online learning platform with course management, video streaming, quizzes, certificates, and student progress tracking. Supports multiple instructors and thousands of students.',
            'project_date' => '2023-09-05',
            'project_url' => 'https://edutech.example.com',
            'technologies' => ['Laravel', 'Livewire', 'FFmpeg', 'PostgreSQL'],
            'is_featured' => false,
            'order' => 4,
        ]);
    }
}
