<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test email to verify SMTP configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email') ?: 'test@example.com';

        $this->info('Sending test email to: ' . $email);
        $this->info('SMTP Host: ' . config('mail.mailers.smtp.host'));
        $this->info('SMTP Port: ' . config('mail.mailers.smtp.port'));
        $this->info('From: ' . config('mail.from.address'));

        try {
            Mail::raw('This is a test email from BASE CMS to verify SMTP configuration.', function ($message) use ($email) {
                $message->to($email)
                    ->subject('Test Email - BASE CMS SMTP Configuration');
            });

            $this->info('✅ Email sent successfully!');
            $this->info('Check your Mailtrap inbox at: https://mailtrap.io/inboxes');

            return 0;
        } catch (\Exception $e) {
            $this->error('❌ Email failed to send!');
            $this->error('Error: ' . $e->getMessage());

            return 1;
        }
    }
}
