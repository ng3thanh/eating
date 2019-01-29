<?php

use Illuminate\Database\Seeder;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;

class SentinelDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create Users
        DB::table('users')->truncate();

        DB::table('users')->insert([
            'username' => 'ng3thanh',
            'email'    => 'ng3thanh@admin.com',
            'password' => bcrypt('iloveyou'),
            'first_name' => 'Thanh',
            'last_name' => 'Nguyen',
            'address' => 'Luong The Vinh street, Ha Noi, Viet Nam',
            'phone' => '0936200593',
            'birthday' => '1993-05-20',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'username' => 'honglt',
            'email'    => 'honglt@admin.com',
            'password' => bcrypt('iloveyou'),
            'first_name' => 'Hong',
            'last_name' => 'Le',
            'address' => 'Luong The Vinh street, Ha Noi, Viet Nam',
            'phone' => '0936200593',
            'birthday' => '1996-01-03',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
