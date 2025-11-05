<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::create([
            'name' => 'BASE Administrator',
            'email' => 'admin@base-scotland.com',
            'password' => bcrypt('password'),
            'is_active' => true,
        ]);

        $adminRole = \App\Models\Role::where('slug', 'admin')->first();
        if ($adminRole) {
            $admin->roles()->attach($adminRole->id);
        }

        $editor = \App\Models\User::create([
            'name' => 'BASE Editor',
            'email' => 'editor@base-scotland.com',
            'password' => bcrypt('password'),
            'is_active' => true,
        ]);

        $editorRole = \App\Models\Role::where('slug', 'editor')->first();
        if ($editorRole) {
            $editor->roles()->attach($editorRole->id);
        }
    }
}
