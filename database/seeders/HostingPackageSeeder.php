<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HostingPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creating hosting packages...');

        DB::table('hosting_packages')->insert([
            [
                'name' => 'Starter',
                'slug' => 'starter',
                'disk_space_gb' => 10,
                'bandwidth_gb' => 100,
                'monthly_price' => 9.99,
                'annual_price' => 99.00,
                'status' => 'active',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'disk_space_gb' => 50,
                'bandwidth_gb' => 500,
                'monthly_price' => 19.99,
                'annual_price' => 199.00,
                'status' => 'active',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Enterprise',
                'slug' => 'enterprise',
                'disk_space_gb' => 200,
                'bandwidth_gb' => 2000,
                'monthly_price' => 49.99,
                'annual_price' => 499.00,
                'status' => 'active',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->command->info('✅ Hosting packages created successfully!');
    }
}
