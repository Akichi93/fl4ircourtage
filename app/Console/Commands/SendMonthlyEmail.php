<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Mail\MonthlyEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMonthlyEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        // Logic to send the monthly email
        // Logic to find users with expiring contracts (adjust the conditions accordingly)
        $usersWithExpiringContracts = User::where('contract_expiration_date', '<=', now()->addMonth())
            ->where('contract_expiration_date', '>', now())
            ->get();

        foreach ($usersWithExpiringContracts as $user) {
            // Send email to users with expiring contracts
            Mail::to($user->email)->send(new MonthlyEmail());
        }

        $this->info('Monthly emails sent to users with expiring contracts!');
    }
}
