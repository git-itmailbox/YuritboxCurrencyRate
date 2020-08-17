<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create {--username=} {--password=secret} {--email=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user with username and password given';

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
        $username = $this->option('username');
        $password = $this->option('password');
        $email = $this->option('email');
        if(!$username || !$email) {
            $this->info('You did not provide email or username, so enter them now both');
            $username = $this->ask('Please input username');
            $email = $this->ask('Please input email');
            $password = $this->ask('Please input password');
        }
        User::create([
            'name' => $username,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);
        return 0;
    }
}
