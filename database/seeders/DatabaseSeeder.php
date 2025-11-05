<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('🌱 Seeding BASE CMS Platform...');
        $this->command->newLine();

        // Seed BASE CMS data (in order)
        $this->call([
            RoleSeeder::class,          // 1. Create roles first
            UserSeeder::class,          // 2. Create admin users
            PageSeeder::class,          // 3. Create static pages (Privacy, Terms, etc.)
            BaseContentSeeder::class,   // 4. Create content (programs, support areas, posts, etc.)
            ActivitySeeder::class,      // 5. Create 50 activities from React codebase
            HighlightSeeder::class,     // 6. Create 3 highlights from React codebase
        ]);

        $this->command->newLine();
        $this->command->info('✅ BASE CMS platform seeded successfully!');
        $this->command->newLine();
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->command->info('📊 SEEDING SUMMARY');
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->command->info('✅ 3 Roles created (Administrator, Editor, Author)');
        $this->command->info('✅ 2 Admin users created');
        $this->command->info('✅ 4 Static Pages created (Privacy Policy, Terms, Cookie Policy, FAQ)');
        $this->command->info('✅ 6 Programs created (Startup Accelerator, Growth Programme, etc.)');
        $this->command->info('✅ 8 Support Areas created');
        $this->command->info('✅ 3 Testimonials created');
        $this->command->info('✅ 4 Categories & 6 Tags created');
        $this->command->info('✅ 3 Sample Posts created');
        $this->command->info('✅ 10 Site Settings created');
        $this->command->info('✅ 50 Activities created (from React codebase)');
        $this->command->info('✅ 3 Highlights created (from React codebase)');
        $this->command->newLine();
        $this->command->info('🔐 ADMIN LOGIN:');
        $this->command->info('   URL: http://localhost/base/admin');
        $this->command->info('   Email: admin@base-scotland.com');
        $this->command->info('   Password: password');
        $this->command->newLine();
        $this->command->info('🌐 FRONT-END:');
        $this->command->info('   URL: http://localhost/base/');
        $this->command->newLine();
        $this->command->warn('⚠️  SECURITY: Change default passwords in production!');
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    }
}
