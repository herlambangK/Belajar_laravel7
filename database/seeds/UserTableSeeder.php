<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Bembiee',
            'username' => 'bembiee',
            'password' => bcrypt('password'),
            'email' => 'bem@gmail.com',
    
        ]);
    }
        
}