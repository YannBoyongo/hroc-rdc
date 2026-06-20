<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create the first admin user if it doesn't exist
        if (! User::where('email', 'admin@hroc-rdc.org')->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@hroc-rdc.org',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);

            $this->command->info('First user created: admin@hroc-rdc.org');
            $this->command->warn('Default password is: password');
            $this->command->warn('Please change the password after first login!');
        } else {
            $this->command->info('First user already exists.');
        }

        // Seed settings
        $this->call(SettingsSeeder::class);
    }
}
