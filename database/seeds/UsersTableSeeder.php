<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
	    $admin->name = 'Admin';
	    $admin->email = 'admin@gmail.com';
	    $admin->unite = 0;
	    $admin->unite_id = 0;
	    $admin->password = Hash::make('password');
	    $admin->is_admin = 1;
	    $admin->save();

	    $userHennaya = new User();
	    $userHennaya->name = 'UserHennaya';
	    $userHennaya->email = 'userHennaya@gmail.com';
	    $userHennaya->unite = 2;
	    $userHennaya->unite_id = 1;
	    $userHennaya->password = Hash::make('password');
	    $userHennaya->is_admin = 0;
		$userHennaya->save();
		
		$userTerga = new User();
	    $userTerga->name = 'UserTerga';
	    $userTerga->email = 'userTerga@gmail.com';
	    $userTerga->unite = 1;
	    $userTerga->unite_id = 2;
	    $userTerga->password = Hash::make('password');
	    $userTerga->is_admin = 0;
	    $userTerga->save();
    }
}
