<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CompanySettingSeeder::class,
            ServiceSeeder::class,
            PortfolioSeeder::class,
            BlogSeeder::class,
            TeamMemberSeeder::class,
            TestimonialSeeder::class,
            JobSeeder::class,
            FaqSeeder::class,
            SliderSeeder::class,
        ]);
    }
}
