<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::where('role', 'content_manager')->first() ?? User::first();

        // Create Categories
        $techNews = BlogCategory::create([
            'name' => 'Technology News',
            'slug' => 'technology-news',
            'description' => 'Latest tech news and trends',
        ]);

        $tutorials = BlogCategory::create([
            'name' => 'Tutorials',
            'slug' => 'tutorials',
            'description' => 'Step-by-step guides and tutorials',
        ]);

        $insights = BlogCategory::create([
            'name' => 'Industry Insights',
            'slug' => 'industry-insights',
            'description' => 'Analysis and insights',
        ]);

        // Create Tags
        $laravel = BlogTag::create(['name' => 'Laravel', 'slug' => 'laravel']);
        $webdev = BlogTag::create(['name' => 'Web Development', 'slug' => 'web-development']);
        $ai = BlogTag::create(['name' => 'Artificial Intelligence', 'slug' => 'artificial-intelligence']);
        $mobile = BlogTag::create(['name' => 'Mobile', 'slug' => 'mobile']);
        $cloud = BlogTag::create(['name' => 'Cloud Computing', 'slug' => 'cloud-computing']);

        // Create Blog Posts
        $post1 = BlogPost::create([
            'blog_category_id' => $tutorials->id,
            'user_id' => $author->id,
            'title' => 'Getting Started with Laravel 11: A Complete Guide',
            'slug' => 'getting-started-with-laravel-11',
            'excerpt' => 'Learn how to build modern web applications with Laravel 11, the latest version of the popular PHP framework.',
            'content' => "Laravel 11 brings exciting new features and improvements that make web development even more enjoyable. In this comprehensive guide, we'll walk through setting up your first Laravel 11 project.\n\nKey topics covered:\n- Installation and setup\n- Routing and controllers\n- Database migrations\n- Blade templating\n- Authentication\n\nBy the end of this tutorial, you'll have a solid foundation in Laravel development and be ready to build your own applications.",
            'meta_title' => 'Laravel 11 Tutorial - Complete Beginner\'s Guide',
            'meta_description' => 'Step-by-step tutorial for getting started with Laravel 11 web development',
            'is_published' => true,
            'published_at' => now()->subDays(5),
        ]);
        $post1->tags()->attach([$laravel->id, $webdev->id]);

        $post2 = BlogPost::create([
            'blog_category_id' => $techNews->id,
            'user_id' => $author->id,
            'title' => 'The Future of AI in Web Development',
            'slug' => 'future-of-ai-in-web-development',
            'excerpt' => 'Exploring how artificial intelligence is revolutionizing the way we build and maintain web applications.',
            'content' => "Artificial Intelligence is transforming every aspect of web development, from automated code generation to intelligent testing and optimization.\n\nCurrent AI trends in web development:\n- AI-powered code completion\n- Automated testing and bug detection\n- Intelligent UX optimization\n- Natural language interfaces\n\nAs AI tools become more sophisticated, developers can focus on creative problem-solving while AI handles repetitive tasks.",
            'meta_title' => 'AI in Web Development - Future Trends',
            'meta_description' => 'How AI is changing web development and what to expect in the future',
            'is_published' => true,
            'published_at' => now()->subDays(10),
        ]);
        $post2->tags()->attach([$ai->id, $webdev->id]);

        $post3 = BlogPost::create([
            'blog_category_id' => $insights->id,
            'user_id' => $author->id,
            'title' => 'Mobile-First Development: Best Practices for 2024',
            'slug' => 'mobile-first-development-best-practices',
            'excerpt' => 'Essential strategies and techniques for building mobile-first web applications in the modern era.',
            'content' => "With mobile devices accounting for over 60% of web traffic, mobile-first development is no longer optional—it's essential.\n\nBest practices:\n- Progressive enhancement\n- Touch-friendly interfaces\n- Optimized performance\n- Responsive images\n- Offline functionality\n\nAdopting a mobile-first approach ensures your applications provide excellent experiences across all devices.",
            'meta_title' => 'Mobile-First Development Best Practices 2024',
            'meta_description' => 'Learn the best practices for mobile-first web development',
            'is_published' => true,
            'published_at' => now()->subDays(3),
        ]);
        $post3->tags()->attach([$mobile->id, $webdev->id]);

        $post4 = BlogPost::create([
            'blog_category_id' => $tutorials->id,
            'user_id' => $author->id,
            'title' => 'Cloud Deployment Strategies for Modern Applications',
            'slug' => 'cloud-deployment-strategies',
            'excerpt' => 'A practical guide to deploying applications on cloud platforms like AWS, Google Cloud, and Azure.',
            'content' => "Cloud deployment offers scalability, reliability, and cost-effectiveness. This guide covers deployment strategies for modern web applications.\n\nTopics covered:\n- Choosing the right cloud provider\n- Container orchestration\n- CI/CD pipelines\n- Monitoring and logging\n- Cost optimization\n\nLearn how to deploy your applications efficiently and manage them at scale.",
            'meta_title' => 'Cloud Deployment Guide - AWS, GCP, Azure',
            'meta_description' => 'Comprehensive guide to cloud deployment strategies',
            'is_published' => true,
            'published_at' => now()->subDays(7),
        ]);
        $post4->tags()->attach([$cloud->id, $webdev->id]);
    }
}
