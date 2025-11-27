<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hakikisha table ya users ipo
        if (!Schema::hasTable('users')) {
            $this->command->error('Users table does not exist!');
            return;
        }

        // Check if is_admin column exists, kama haipo, iadd manually
        if (!Schema::hasColumn('users', 'is_admin')) {
            $this->command->info('Adding is_admin column to users table...');
            Schema::table('users', function ($table) {
                $table->boolean('is_admin')->default(false)->after('email');
            });
        }

        // Create or update admin user
        $admin = User::updateOrCreate(
            ['email' => 'admin@portifolio.com'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('hacker3r'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin user created/updated successfully!');
        $this->command->info('Email: admin@portifolio.com');
        $this->command->info('Password: hacker3r');
        $this->command->info('Is Admin: ' . ($admin->is_admin ? 'Yes' : 'No'));
    }
}