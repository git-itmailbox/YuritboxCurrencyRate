<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@adm.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $this->call([
            CurrencySeeder::class,
            HistorySeeder::class
        ]);
    }
}
