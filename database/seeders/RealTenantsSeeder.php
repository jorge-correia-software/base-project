<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\TenantUser;
use App\Models\HostingPackage;
use App\Models\CreditPackage;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RealTenantsSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Creating real customer tenants...');

        // Get hosting packages
        $starter = HostingPackage::where('slug', 'starter')->first();
        $business = HostingPackage::where('slug', 'business')->first();
        $enterprise = HostingPackage::where('slug', 'enterprise')->first();

        // Get credit packages for initial allocations
        $package9 = CreditPackage::where('slug', 'package-9')->first();
        $package15 = CreditPackage::where('slug', 'package-15')->first();
        $package45 = CreditPackage::where('slug', 'package-45')->first();
        $welcome5 = CreditPackage::where('slug', 'welcome-5')->first();

        $tenants = [
            [
                'name' => 'Edinburgh College',
                'slug' => 'edinburgh-college',
                'domain' => 'edinburgh-college.ubdomains.local',
                'hosting_package' => $enterprise,
                'credit_package' => $package15,
                'email' => 'admin@edinburghcollege.ac.uk',
                'contact_name' => 'Sarah MacLeod',
                'phone' => '+44 131 669 4400',
                'address' => 'Granton Campus, 350 West Granton Road',
                'city' => 'Edinburgh',
                'postcode' => 'EH5 1QE',
                'country' => 'United Kingdom',
                'project' => [
                    'name' => 'Student Portal Enhancement',
                    'description' => 'Upgrade the student portal with improved course management and communication features',
                    'status' => 'in_progress',
                    'priority' => 'high',
                    'hours_estimated' => 40,
                    'end_date' => now()->addMonths(2),
                ],
            ],
            [
                'name' => 'Vaste Technologies',
                'slug' => 'vaste-tech',
                'domain' => 'vaste-tech.ubdomains.local',
                'hosting_package' => $enterprise,
                'credit_package' => $package45,
                'email' => 'admin@vaste.tech',
                'contact_name' => 'Jorge Fonseca',
                'phone' => '+44 131 555 0100',
                'address' => '10 Tech Plaza',
                'city' => 'Edinburgh',
                'postcode' => 'EH1 3EG',
                'country' => 'United Kingdom',
                'project' => [
                    'name' => 'Symphony Platform Updates',
                    'description' => 'Major updates to the Symphony biogas monitoring platform including new analytics features',
                    'status' => 'in_progress',
                    'priority' => 'urgent',
                    'hours_estimated' => 80,
                    'budget' => 5000,
                    'end_date' => now()->addMonth(),
                ],
            ],
            [
                'name' => 'In My Neighbourhood',
                'slug' => 'in-my-neighbourhood',
                'domain' => 'inmyneighbourhood.ubdomains.local',
                'hosting_package' => $business,
                'credit_package' => $package9,
                'email' => 'admin@inmyneighbourhood.org',
                'contact_name' => 'Emma Wilson',
                'phone' => '+44 131 555 0200',
                'address' => '15 Community Street',
                'city' => 'Edinburgh',
                'postcode' => 'EH2 4AP',
                'country' => 'United Kingdom',
                'project' => [
                    'name' => 'Community Portal Development',
                    'description' => 'Build a community engagement platform for local residents to connect and share resources',
                    'status' => 'planning',
                    'priority' => 'medium',
                    'hours_estimated' => 25,
                    'budget' => 1500,
                    'end_date' => now()->addMonths(3),
                ],
            ],
            [
                'name' => 'Lothian Massage & Acupuncture',
                'slug' => 'lothian-massage',
                'domain' => 'lothian-massage.ubdomains.local',
                'hosting_package' => $starter,
                'credit_package' => $welcome5,
                'email' => 'admin@lothianmassage.co.uk',
                'contact_name' => 'Dr. James Chen',
                'phone' => '+44 131 555 0300',
                'address' => '42 Wellness Avenue',
                'city' => 'Edinburgh',
                'postcode' => 'EH3 6JH',
                'country' => 'United Kingdom',
                'project' => [
                    'name' => 'Online Booking System',
                    'description' => 'Implement an online appointment booking system integrated with the practice management software',
                    'status' => 'in_progress',
                    'priority' => 'high',
                    'hours_estimated' => 15,
                    'budget' => 800,
                    'end_date' => now()->addWeeks(6),
                ],
            ],
            [
                'name' => 'The Royal Company of Merchants',
                'slug' => 'royal-merchants',
                'domain' => 'royal-merchants.ubdomains.local',
                'hosting_package' => $business,
                'credit_package' => $package15,
                'email' => 'admin@royalmerchants.org.uk',
                'contact_name' => 'Alexander Stewart',
                'phone' => '+44 131 555 0400',
                'address' => 'Merchants Hall, 22 Hanover Street',
                'city' => 'Edinburgh',
                'postcode' => 'EH2 2EP',
                'country' => 'United Kingdom',
                'project' => [
                    'name' => 'Member Directory System',
                    'description' => 'Create a searchable member directory with profiles and business networking features',
                    'status' => 'planning',
                    'priority' => 'medium',
                    'hours_estimated' => 30,
                    'budget' => 2000,
                    'end_date' => now()->addMonths(4),
                ],
            ],
            [
                'name' => 'ApparelXchange',
                'slug' => 'apparelxchange',
                'domain' => 'apparelxchange.ubdomains.local',
                'hosting_package' => $enterprise,
                'credit_package' => $package45,
                'email' => 'admin@apparelxchange.com',
                'contact_name' => 'Rachel Thompson',
                'phone' => '+44 131 555 0500',
                'address' => '88 Fashion Street',
                'city' => 'Edinburgh',
                'postcode' => 'EH4 8HL',
                'country' => 'United Kingdom',
                'project' => [
                    'name' => 'E-commerce Platform Enhancement',
                    'description' => 'Add advanced filtering, personalized recommendations, and mobile app integration',
                    'status' => 'in_progress',
                    'priority' => 'urgent',
                    'hours_estimated' => 60,
                    'budget' => 8000,
                    'end_date' => now()->addWeeks(8),
                ],
            ],
        ];

        foreach ($tenants as $data) {
            $this->createTenant($data);
        }

        $this->command->info('✅ All real tenants created successfully!');
        $this->command->newLine();
        $this->command->info('Created tenants:');
        foreach ($tenants as $tenant) {
            $this->command->info("  - {$tenant['name']} ({$tenant['slug']})");
        }
        $this->command->newLine();
        $this->command->info('You can access them at:');
        foreach ($tenants as $tenant) {
            $this->command->info("  http://localhost:8000/t/{$tenant['slug']}/login");
        }
        $this->command->newLine();
        $this->command->info('Default credentials for all tenants:');
        $this->command->info('  Email: [tenant email]');
        $this->command->info('  Password: password');
    }

    private function createTenant(array $data): void
    {
        $this->command->info("Creating {$data['name']}...");

        // Check if tenant already exists by slug
        if (DB::table('tenants')->where('slug', $data['slug'])->exists()) {
            $this->command->warn("  ⚠ {$data['name']} already exists, skipping...");
            return;
        }

        // Create tenant (id will auto-increment - BIGINT)
        $tenant = Tenant::create([
            'slug' => $data['slug'],
            'name' => $data['name'],
            'contact_name' => $data['contact_name'],
            'contact_email' => $data['email'],
            'contact_phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'postcode' => $data['postcode'],
            'country' => $data['country'],
            'status' => 'active',
            'credit_hours_balance' => 0, // Will be updated by credit_hours event
            'data' => [],
        ]);

        // Create domain (use auto-incremented tenant->id)
        DB::table('domains')->insert([
            'tenant_id' => $tenant->id,
            'domain' => $data['domain'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create hosting subscription (normalized)
        DB::table('hosting_subscriptions')->insert([
            'tenant_id' => $tenant->id,
            'hosting_package_id' => $data['hosting_package']->id,
            'billing_cycle' => 'annual',
            'starts_at' => now()->subMonths(3),
            'ends_at' => now()->addMonths(9),
            'renewal_date' => now()->addMonths(9),
            'status' => 'active',
            'price' => $data['hosting_package']->annual_price,
            'is_trial' => false,
            'trial_ends_at' => null,
            'invoice_id' => null,
            'notes' => 'Initial subscription',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create credit package purchase (normalized)
        $purchase = DB::table('credit_package_purchases')->insertGetId([
            'tenant_id' => $tenant->id,
            'credit_package_id' => $data['credit_package']->id,
            'hours_purchased' => $data['credit_package']->hours,
            'hours_used' => 0,
            'hours_remaining' => $data['credit_package']->hours,
            'price' => $data['credit_package']->price,
            'purchased_at' => now()->subMonths(3),
            'expires_at' => null,
            'status' => 'active',
            'invoice_id' => null,
            'notes' => 'Initial credit package allocation',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create credit hours allocation entry (linked to purchase)
        DB::table('credit_hours')->insert([
            'tenant_id' => $tenant->id,
            'project_id' => null,
            'credit_package_purchase_id' => $purchase,
            'type' => 'allocation',
            'date' => now()->subMonths(3),
            'description' => "Initial credit hours allocation - {$data['credit_package']->name}",
            'hours' => $data['credit_package']->hours,
            'performed_by' => null,
            'notes' => 'Package: ' . $data['credit_package']->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Get tenant admin role ID
        $tenantAdminRoleId = DB::table('roles')
            ->where('user_type', 'tenant_user')
            ->where('slug', 'tenant-admin')
            ->value('id');

        // Create tenant admin user
        TenantUser::create([
            'tenant_id' => $tenant->id,
            'role_id' => $tenantAdminRoleId,
            'name' => $data['contact_name'],
            'email' => $data['email'],
            'password' => Hash::make('password'),
            'status' => 'active',
            'is_primary' => true,
        ]);

        // Create project with end_date (not deadline)
        $project = Project::create([
            'tenant_id' => $tenant->id,
            'name' => $data['project']['name'],
            'description' => $data['project']['description'],
            'status' => $data['project']['status'],
            'priority' => $data['project']['priority'],
            'budget' => $data['project']['budget'] ?? null,
            'hours_estimated' => $data['project']['hours_estimated'],
            'hours_used' => 0,
            'start_date' => $data['project']['status'] === 'planning' ? null : now()->subWeeks(2),
            'end_date' => $data['project']['end_date'],
            'assigned_to' => null,
        ]);

        $this->command->info("  ✓ {$data['name']} created with {$data['credit_package']->hours}h credit hours");
    }
}
