<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        TeamMember::create([
            'name' => 'Alex Thompson',
            'position' => 'Chief Executive Officer',
            'department' => 'Executive',
            'bio' => 'With over 15 years of experience in technology leadership, Alex drives the company\'s vision and strategy.',
            'email' => 'alex@techcorp.com',
            'social_links' => [
                'linkedin' => 'https://linkedin.com/in/alexthompson',
                'twitter' => 'https://twitter.com/alexthompson',
            ],
            'order' => 1,
        ]);

        TeamMember::create([
            'name' => 'Sarah Martinez',
            'position' => 'Chief Technology Officer',
            'department' => 'Engineering',
            'bio' => 'Sarah leads our engineering team, ensuring we deliver cutting-edge solutions using the latest technologies.',
            'email' => 'sarah@techcorp.com',
            'social_links' => [
                'linkedin' => 'https://linkedin.com/in/sarahmartinez',
                'github' => 'https://github.com/sarahmartinez',
            ],
            'order' => 2,
        ]);

        TeamMember::create([
            'name' => 'David Chen',
            'position' => 'Lead Frontend Developer',
            'department' => 'Engineering',
            'bio' => 'David specializes in creating beautiful and performant user interfaces using modern frameworks.',
            'email' => 'david@techcorp.com',
           'social_links' => [
                'linkedin' => 'https://linkedin.com/in/davidchen',
                'github' => 'https://github.com/davidchen',
            ],
            'order' => 3,
        ]);

        TeamMember::create([
            'name' => 'Lisa Anderson',
            'position' => 'UX/UI Designer',
            'department' => 'Design',
            'bio' => 'Lisa creates intuitive and engaging user experiences that delight our clients and their customers.',
            'email' => 'lisa@techcorp.com',
            'social_links' => [
                'linkedin' => 'https://linkedin.com/in/lisaanderson',
                'dribbble' => 'https://dribbble.com/lisaanderson',
            ],
            'order' => 4,
        ]);
    }
}
