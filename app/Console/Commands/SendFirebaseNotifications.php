<?php

namespace App\Console\Commands;

use App\Jobs\FirebaseNotificationJob;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Console\Command;

class SendFirebaseNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'firebase:notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send all pending firebase notifications.';

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
        
    }
}
