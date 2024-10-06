<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'       => 'User',
            'email'      => 'user@gmail.com',
            'password'   => Hash::make('12345678'),
            'gender'     => '1',
            'created_by' => 'Admin',
            'created_at' => Carbon::now()
        ]);
    }
}
