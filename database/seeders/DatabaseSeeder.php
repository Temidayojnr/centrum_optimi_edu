<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Program;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@centrumoptimi.org',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        // Create Content Editor
        User::create([
            'name' => 'Content Editor',
            'email' => 'editor@centrumoptimi.org',
            'password' => Hash::make('password'),
            'role' => 'content_editor',
            'is_active' => true,
        ]);

        // Create Sample Programs
        $programs = [
            [
                'title' => 'Rural Education Initiative',
                'slug' => 'rural-education-initiative',
                'description' => 'Bringing quality education to rural communities through mobile learning centers.',
                'content' => '<p>Our Rural Education Initiative aims to bridge the educational gap in underserved rural areas by providing access to modern learning tools and qualified teachers.</p>',
                'status' => 'active',
                'location' => 'Various Rural Communities',
                'beneficiaries' => 500,
                'budget' => 5000000.00,
                'is_featured' => true,
                'is_published' => true,
                'start_date' => now()->subMonths(6),
            ],
            [
                'title' => 'Skills Development Program',
                'slug' => 'skills-development-program',
                'description' => 'Empowering youth with practical vocational skills for sustainable livelihood.',
                'content' => '<p>This program focuses on equipping young people with marketable skills in various trades including technology, agriculture, and entrepreneurship.</p>',
                'status' => 'active',
                'location' => 'Training Centers',
                'beneficiaries' => 300,
                'budget' => 3000000.00,
                'is_featured' => true,
                'is_published' => true,
                'start_date' => now()->subMonths(3),
            ],
            [
                'title' => 'Girls Education Support',
                'slug' => 'girls-education-support',
                'description' => 'Supporting girl-child education through scholarships and mentorship.',
                'content' => '<p>We believe in the power of educating girls to transform communities. This program provides scholarships and mentorship to young girls from underprivileged backgrounds.</p>',
                'status' => 'active',
                'location' => 'Multiple Schools',
                'beneficiaries' => 200,
                'budget' => 2500000.00,
                'is_featured' => true,
                'is_published' => true,
                'start_date' => now()->subYear(),
            ],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }

        // Create Sample Blog Posts
        $posts = [
            [
                'title' => 'Launching Our New Rural Education Centers',
                'slug' => 'launching-new-rural-education-centers',
                'excerpt' => 'We are excited to announce the opening of three new mobile learning centers.',
                'content' => '<p>Education is the foundation of progress. Today marks a significant milestone as we launch three new mobile learning centers in remote communities.</p>',
                'user_id' => 1,
                'author_name' => 'Super Admin',
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'is_featured' => true,
                'views' => 150,
            ],
            [
                'title' => 'Impact Report: 500 Students Graduated',
                'slug' => 'impact-report-500-students-graduated',
                'excerpt' => 'Our skills development program has successfully trained 500 students this year.',
                'content' => '<p>We are proud to share that 500 young people have successfully completed our skills development program this year.</p>',
                'user_id' => 1,
                'author_name' => 'Super Admin',
                'status' => 'published',
                'published_at' => now()->subDays(10),
                'is_featured' => false,
                'views' => 200,
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
