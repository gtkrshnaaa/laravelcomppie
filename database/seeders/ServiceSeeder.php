<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Create Categories
        $webDev = ServiceCategory::create([
            'name' => 'Web Development',
            'slug' => 'web-development',
            'description' => 'Custom web applications and websites',
        ]);

        $mobileDev = ServiceCategory::create([
            'name' => 'Mobile Development',
            'slug' => 'mobile-development',
            'description' => 'iOS and Android applications',
        ]);

        $consulting = ServiceCategory::create([
            'name' => 'Consulting',
            'slug' => 'consulting',
            'description' => 'Technology consulting and strategy',
        ]);

        // Create Services
        Service::create([
            'service_category_id' => $webDev->id,
            'name' => 'Custom Web Applications',
            'slug' => 'custom-web-applications',
            'short_description' => 'Build scalable and robust web applications tailored to your business needs',
            'description' => 'Our team develops custom web applications using the latest technologies including Laravel, React, and Vue.js. We focus on creating scalable, secure, and user-friendly solutions that drive business growth.',
            'icon' => '🌐',
            'features' => ['Custom Design', 'Responsive Layout', 'API Integration', 'Admin Dashboard', 'Security Features'],
            'is_featured' => true,
            'price_starting_from' => 5000,
            'order' => 1,
        ]);

        Service::create([
            'service_category_id' => $webDev->id,
            'name' => 'E-Commerce Solutions',
            'slug' => 'e-commerce-solutions',
            'short_description' => 'Complete online store solutions with payment gateway integration',
            'description' => 'Launch your online business with our comprehensive e-commerce solutions. We integrate secure payment gateways, inventory management, and provide a seamless shopping experience.',
            'icon' => '🛒',
            'features' => ['Payment Integration', 'Inventory Management', 'Order Tracking', 'Customer Accounts', 'Analytics Dashboard'],
            'is_featured' => true,
            'price_starting_from' => 7500,
            'order' => 2,
        ]);

        Service::create([
            'service_category_id' => $mobileDev->id,
            'name' => 'iOS App Development',
            'slug' => 'ios-app-development',
            'short_description' => 'Native iOS applications for iPhone and iPad',
            'description' => 'Create stunning iOS applications using Swift and modern development practices. We deliver apps that provide exceptional user experiences on all Apple devices.',
            'icon' => '📱',
            'features' => ['Native Development', 'App Store Optimization', 'Push Notifications', 'Offline Mode', 'iCloud Integration'],
            'is_featured' => false,
            'price_starting_from' => 10000,
            'order' => 3,
        ]);

        Service::create([
            'service_category_id' => $mobileDev->id,
            'name' => 'Android App Development',
            'slug' => 'android-app-development',
            'short_description' => 'High-performance Android applications',
            'description' => 'Develop feature-rich Android applications using Kotlin and Java. We ensure your app performs flawlessly across all Android devices.',
            'icon' => '🤖',
            'features' => ['Material Design', 'Google Play Services', 'Real-time Updates', 'Multi-device Support', 'Performance Optimization'],
            'is_featured' => false,
            'price_starting_from' => 10000,
            'order' => 4,
        ]);

        Service::create([
            'service_category_id' => $consulting->id,
            'name' => 'Digital Transformation Consulting',
            'slug' => 'digital-transformation-consulting',
            'short_description' => 'Strategic guidance for digital transformation initiatives',
            'description' => 'Navigate your digital transformation journey with our expert consulting services. We help you modernize operations, improve customer experiences, and drive innovation.',
            'icon' => '💡',
            'features' => ['Strategy Development', 'Technology Assessment', 'Process Optimization', 'Change Management', 'ROI Analysis'],
            'is_featured' => true,
            'price_starting_from' => 3000,
            'order' => 5,
        ]);

        Service::create([
            'service_category_id' => $consulting->id,
            'name' => 'Cloud Migration Services',
            'slug' => 'cloud-migration-services',
            'short_description' => 'Seamless migration to cloud infrastructure',
            'description' => 'Move your applications and data to the cloud with minimal disruption. We provide comprehensive migration planning, execution, and optimization services.',
            'icon' => '☁️',
            'features' => ['Migration Planning', 'Data Transfer', 'Security Configuration', 'Cost Optimization', '24/7 Support'],
            'is_featured' => false,
            'price_starting_from' => 4000,
            'order' => 6,
        ]);
    }
}
