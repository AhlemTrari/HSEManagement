<?php

use App\Unite;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unites')->insert([
            ['nom' => "Hennaya",],
            ['nom' => "Terga"],
        ]);
    }
}
