<?php

namespace Database\Seeders;

use App\Models\UBUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UBUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creating UBDomains platform administrators...');

        // Get role IDs
        $superAdminRoleId = DB::table('roles')->where('slug', 'super-admin')->where('user_type', 'ub_user')->value('id');
        $adminRoleId = DB::table('roles')->where('slug', 'admin')->where('user_type', 'ub_user')->value('id');
        $supportRoleId = DB::table('roles')->where('slug', 'support')->where('user_type', 'ub_user')->value('id');
        $viewerRoleId = DB::table('roles')->where('slug', 'viewer')->where('user_type', 'ub_user')->value('id');

        // Super Admin
        UBUser::updateOrCreate(
            ['email' => 'admin@ubdomains.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role_id' => $superAdminRoleId,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // Platform Admin
        UBUser::updateOrCreate(
            ['email' => 'platform@ubdomains.com'],
            [
                'name' => 'Platform Admin',
                'password' => Hash::make('password'),
                'role_id' => $adminRoleId,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // Support Manager
        UBUser::updateOrCreate(
            ['email' => 'support@ubdomains.com'],
            [
                'name' => 'Support Manager',
                'password' => Hash::make('password'),
                'role_id' => $supportRoleId,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // Viewer
        UBUser::updateOrCreate(
            ['email' => 'viewer@ubdomains.com'],
            [
                'name' => 'Read-Only Viewer',
                'password' => Hash::make('password'),
                'role_id' => $viewerRoleId,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✅ UBDomains administrators created successfully!');
        $this->command->newLine();
        $this->command->info('Login credentials (all passwords: "password"):');
        $this->command->info('  Super Admin: admin@ubdomains.com');
        $this->command->info('  Platform Admin: platform@ubdomains.com');
        $this->command->info('  Support Manager: support@ubdomains.com');
        $this->command->info('  Viewer: viewer@ubdomains.com');
        $this->command->newLine();
        $this->command->warn('⚠️  IMPORTANT: Change these passwords in production!');
    }
}
