<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        // Create Jobs
        $job1 = Job::create([
            'title' => 'Senior Laravel Developer',
            'slug' => 'senior-laravel-developer',
            'department' => 'Engineering',
            'location' => 'Remote',
            'type' => 'full_time',
            'description' => 'We are looking for an experienced Laravel developer to join our growing team. You will be responsible for building scalable web applications and maintaining our existing codebase.',
            'requirements' => "- 5+ years of PHP/Laravel experience\n- Strong understanding of MVC architecture\n- Experience with Vue.js or React\n- Knowledge of MySQL and Redis\n- Excellent problem-solving skills",
            'salary_range' => '$80,000 - $120,000',
            'deadline' => now()->addDays(30),
            'is_active' => true,
        ]);

        $job2 = Job::create([
            'title' => 'UX/UI Designer',
            'slug' => 'ux-ui-designer',
            'department' => 'Design',
            'location' => 'San Francisco, CA',
            'type' => 'full_time',
            'description' => 'Join our design team to create beautiful and intuitive user experiences for our clients. You will work closely with developers and product managers to bring designs to life.',
            'requirements' => "- 3+ years of UX/UI design experience\n- Proficiency in Figma and Adobe Creative Suite\n- Strong portfolio demonstrating web and mobile design\n- Understanding of user-centered design principles\n- Excellent communication skills",
            'salary_range' => '$70,000 - $100,000',
            'deadline' => now()->addDays(45),
            'is_active' => true,
        ]);

        $job3 = Job::create([
            'title' => 'Frontend Developer Intern',
            'slug' => 'frontend-developer-intern',
            'department' => 'Engineering',
            'location' => 'Remote',
            'type' => 'internship',
            'description' => 'This internship provides hands-on experience building modern web applications. You will learn from our senior developers and contribute to real projects.',
            'requirements' => "- Currently pursuing a degree in Computer Science or related field\n- Basic knowledge of HTML, CSS, and JavaScript\n- Familiarity with React or Vue.js\n- Eagerness to learn and grow\n- Strong work ethic",
            'deadline' => now()->addDays(20),
            'is_active' => true,
        ]);

        // Create sample applications
        JobApplication::create([
            'job_id' => $job1->id,
            'full_name' => 'James Wilson',
            'email' => 'james.wilson@email.com',
            'phone' => '+1 (555) 234-5678',
            'cover_letter' => 'I am excited to apply for the Senior Laravel Developer position. With over 6 years of experience building web applications, I believe I would be a great fit for your team.',
            'status' => 'pending',
        ]);

        JobApplication::create([
            'job_id' => $job2->id,
            'full_name' => 'Emma Davis',
            'email' => 'emma.davis@email.com',
            'phone' => '+1 (555) 345-6789',
            'cover_letter' => 'I have been following your company for a while and I am impressed by your design work. I would love the opportunity to contribute my skills to your team.',
            'status' => 'reviewing',
        ]);
    }
}
