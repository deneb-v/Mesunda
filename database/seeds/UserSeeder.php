<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = User::create([
            'name' => 'heathcliff',
            'email' => 'admin@mesunda.com',
            'phone_num' => '085891012863',
            'role' => 'admin',
            'password' =>  Hash::make('12341234')
        ]);
    }
}
