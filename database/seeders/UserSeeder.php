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
        $adminRole = Role::where('slug','admin')->value('id');
        $userRole = Role::where('slug','user')->value('id');

        User::insert([
            ['role_id'=>$adminRole,'name'=>'Admin','email'=>'super@gmail.com','password'=>Hash::make('12345678'),'gender'=>'1','created_by'=>'Admin','created_at'=>Carbon::now()],
            ['role_id'=>$userRole,'name'=>'User','email'=>'admin@gmail.com','password'=>Hash::make('12345678'),'gender'=>'1','created_by'=>'Admin','created_at'=>Carbon::now()]
        ]);
    }
}
