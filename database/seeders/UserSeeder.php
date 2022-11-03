<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Gerald Collins',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
        ]);

        $user->attachRole(1);

        $user = User::create([
            'name' => 'Security',
            'email' => 'secure@secure.com',
            'password' => Hash::make('password')
        ]);

        $user->attachRole(2);

        $user = User::create([
            'name' => 'Resident',
            'email' => 'test@test.com',
            'password' => Hash::make('password')
        ]);

        $user->attachRole(3);
        
    }
}
