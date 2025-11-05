<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanupTenantSoftDeletes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:cleanup-soft-deletes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove deleted_at from JSON data column to fix SoftDeletes compatibility';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting tenant soft deletes cleanup...');

        // Get all tenants with deleted_at in their JSON data
        $tenants = DB::table('tenants')
            ->whereRaw("JSON_EXTRACT(data, '$.deleted_at') IS NOT NULL")
            ->get();

        if ($tenants->isEmpty()) {
            $this->info('No tenants found with deleted_at in JSON data column.');
            return 0;
        }

        $this->info("Found {$tenants->count()} tenant(s) with deleted_at in JSON data.");

        $bar = $this->output->createProgressBar($tenants->count());
        $bar->start();

        $cleaned = 0;

        foreach ($tenants as $tenant) {
            // Decode the JSON data
            $data = json_decode($tenant->data, true) ?? [];

            // Remove deleted_at if it exists
            if (array_key_exists('deleted_at', $data)) {
                unset($data['deleted_at']);

                // Update the tenant with cleaned data
                DB::table('tenants')
                    ->where('id', $tenant->id)
                    ->update(['data' => json_encode($data)]);

                $cleaned++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("Successfully cleaned {$cleaned} tenant(s).");
        $this->info('Soft deletes should now work properly with Laravel\'s SoftDeletes trait.');

        return 0;
    }
}
