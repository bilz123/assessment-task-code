<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Mail\NotificationEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send all pending email notifications.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $admin = User::whereId(1)->first();

        try {
            Mail::to($admin->email)->queue(new NotificationEmail(
                'Notification Email',
                $admin->name,
                'This is a <i>dummy notification</i> to test things out for basic integration.',
                [
                    'heading' => 'Confirm Your E-Mail Address',
                    'quote' => 'This is a dummy qoute to test the email template.',
                    'note' => 'The token will expire in 30 minutes.',
                    'url' => route('home'),
                    'button_text' => 'Dummy Action',
                ]
            ));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
