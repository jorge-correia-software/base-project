<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Administrator',
                'slug' => 'admin',
                'description' => 'Full system access with all permissions',
                'permissions' => json_encode(['*']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Editor',
                'slug' => 'editor',
                'description' => 'Can create, edit, and publish content',
                'permissions' => json_encode([
                    'pages.create', 'pages.edit', 'pages.delete', 'pages.publish',
                    'posts.create', 'posts.edit', 'posts.delete', 'posts.publish',
                    'media.upload', 'media.delete',
                    'categories.create', 'categories.edit',
                    'tags.create', 'tags.edit',
                    'programs.create', 'programs.edit',
                    'support_areas.create', 'support_areas.edit',
                    'testimonials.create', 'testimonials.edit',
                    'hero_sections.create', 'hero_sections.edit',
                    'contact_submissions.view',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Author',
                'slug' => 'author',
                'description' => 'Can create and edit own content',
                'permissions' => json_encode([
                    'posts.create', 'posts.edit',
                    'media.upload',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}
