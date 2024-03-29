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
        $this->call(UniteSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(FonctionSeeder::class);
        $this->call(EmployeSeeder::class);
    }
}
