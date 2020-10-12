<?php

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
        // $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);  //categori seeder
        $this->call(TagsTableSeeder::class);  // tags seeder
        $this->call(UserTableSeeder::class);  // user seeder
    }
}