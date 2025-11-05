<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\HostingSubscription;
use App\Models\CreditPackagePurchase;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creating invoices for tenants...');

        // Get all tenants
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            $this->createInvoicesForTenant($tenant);
        }

        $this->command->info('✅ Invoices created successfully!');
        $this->command->newLine();
    }

    /**
     * Generate tenant initials from name.
     */
    private function getTenantInitials(string $name): string
    {
        // Remove common words and get initials
        $commonWords = ['the', 'of', 'and', '&'];
        $words = explode(' ', strtolower($name));

        $initials = '';
        foreach ($words as $word) {
            if (!in_array($word, $commonWords) && !empty($word)) {
                $initials .= strtoupper($word[0]);
            }
        }

        return $initials;
    }

    /**
     * Generate unique invoice number: {TenantInitials}{YYYYMMDD}
     */
    private function generateInvoiceNumber(Tenant $tenant, $date): string
    {
        $initials = $this->getTenantInitials($tenant->name);
        $dateStr = $date->format('Ymd');

        // Base invoice number
        $baseNumber = "{$initials}{$dateStr}";

        // Check if invoice with this number exists
        $counter = 1;
        $invoiceNumber = $baseNumber;

        while (DB::table('invoices')->where('invoice_number', $invoiceNumber)->exists()) {
            $invoiceNumber = $baseNumber . '-' . $counter;
            $counter++;
        }

        return $invoiceNumber;
    }

    private function createInvoicesForTenant(Tenant $tenant): void
    {
        $this->command->info("  Creating invoices for {$tenant->name}...");

        // Get tenant's hosting subscriptions and credit purchases
        $hostingSubscriptions = HostingSubscription::where('tenant_id', $tenant->id)->get();
        $creditPurchases = CreditPackagePurchase::where('tenant_id', $tenant->id)->get();

        // Create invoice for hosting subscription
        foreach ($hostingSubscriptions as $subscription) {
            $invoiceNumber = $this->generateInvoiceNumber($tenant, $subscription->starts_at);

            $invoiceId = DB::table('invoices')->insertGetId([
                'tenant_id' => $tenant->id,
                'invoice_number' => $invoiceNumber,
                'issue_date' => $subscription->starts_at,
                'due_date' => $subscription->starts_at->addDays(30),
                'subtotal' => $subscription->price,
                'tax_amount' => $subscription->price * 0.20, // 20% VAT
                'total_amount' => $subscription->price * 1.20,
                'status' => 'paid',
                'paid_at' => $subscription->starts_at->addDays(5),
                'payment_method' => 'bank_transfer',
                'notes' => 'Annual hosting subscription',
                'created_at' => $subscription->starts_at,
                'updated_at' => $subscription->starts_at,
            ]);

            // Create invoice item for hosting
            DB::table('invoice_items')->insert([
                'invoice_id' => $invoiceId,
                'item_type' => 'hosting_subscription',
                'item_id' => $subscription->id,
                'description' => "Annual Hosting Subscription - {$subscription->hostingPackage->name}",
                'quantity' => 1,
                'unit_price' => $subscription->price,
                'total_price' => $subscription->price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Update subscription with invoice_id
            DB::table('hosting_subscriptions')
                ->where('id', $subscription->id)
                ->update(['invoice_id' => $invoiceId]);

            $this->command->info("    ✓ Invoice created for hosting subscription ({$subscription->hostingPackage->name})");
        }

        // Create invoice for credit package purchase
        foreach ($creditPurchases as $purchase) {
            $invoiceNumber = $this->generateInvoiceNumber($tenant, $purchase->purchased_at);

            $invoiceId = DB::table('invoices')->insertGetId([
                'tenant_id' => $tenant->id,
                'invoice_number' => $invoiceNumber,
                'issue_date' => $purchase->purchased_at,
                'due_date' => $purchase->purchased_at->addDays(30),
                'subtotal' => $purchase->price,
                'tax_amount' => $purchase->price * 0.20, // 20% VAT
                'total_amount' => $purchase->price * 1.20,
                'status' => $purchase->price > 0 ? 'paid' : 'paid', // All paid for now
                'paid_at' => $purchase->price > 0 ? $purchase->purchased_at->addDays(3) : $purchase->purchased_at,
                'payment_method' => $purchase->price > 0 ? 'credit_card' : null,
                'notes' => $purchase->price > 0 ? 'Credit hours package purchase' : 'Promotional credit hours - no charge',
                'created_at' => $purchase->purchased_at,
                'updated_at' => $purchase->purchased_at,
            ]);

            // Create invoice item for credit package
            DB::table('invoice_items')->insert([
                'invoice_id' => $invoiceId,
                'item_type' => 'credit_package',
                'item_id' => $purchase->id,
                'description' => "{$purchase->creditPackage->name} - {$purchase->hours_purchased} hours",
                'quantity' => 1,
                'unit_price' => $purchase->price,
                'total_price' => $purchase->price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Update purchase with invoice_id
            DB::table('credit_package_purchases')
                ->where('id', $purchase->id)
                ->update(['invoice_id' => $invoiceId]);

            $this->command->info("    ✓ Invoice created for credit package ({$purchase->creditPackage->name})");
        }
    }
}
