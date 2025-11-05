<?php

namespace Database\Seeders;

use App\Models\CreditPackage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CreditPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Had-oc-1',
                'slug' => 'had-oc-1',
                'description' => 'Ad-hoc single hour credit package',
                'hours' => 1.00,
                'price' => 90.00,
                'status' => 'active',
                'sort_order' => 1,
            ],
            [
                'name' => 'Welcome-5',
                'slug' => 'welcome-5',
                'description' => 'Welcome bonus - 5 hours free credit',
                'hours' => 5.00,
                'price' => 0.00,
                'status' => 'active',
                'sort_order' => 2,
            ],
            [
                'name' => 'Bonus-5',
                'slug' => 'bonus-5',
                'description' => 'Promotional bonus - 5 hours free credit',
                'hours' => 5.00,
                'price' => 0.00,
                'status' => 'active',
                'sort_order' => 3,
            ],
            [
                'name' => 'Package-9',
                'slug' => 'package-9',
                'description' => 'Standard package - 9 hours',
                'hours' => 9.00,
                'price' => 540.00,
                'status' => 'active',
                'sort_order' => 4,
            ],
            [
                'name' => 'Package-15',
                'slug' => 'package-15',
                'description' => 'Enhanced package - 15 hours',
                'hours' => 15.00,
                'price' => 900.00,
                'status' => 'active',
                'sort_order' => 5,
            ],
            [
                'name' => 'Package-45',
                'slug' => 'package-45',
                'description' => 'Premium package - 45 hours',
                'hours' => 45.00,
                'price' => 1800.00,
                'status' => 'active',
                'sort_order' => 6,
            ],
        ];

        foreach ($packages as $package) {
            CreditPackage::create($package);
        }

        $this->command->info('Credit packages seeded successfully!');
    }
}
