<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Login\Role;
use Login\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker 		= Faker::create(); 
        $role_user  = Role::where('name', 'user')->first();
        $role_admin = Role::where('name', 'admin')->first();

        // Usuarios Faker
        for ($i=0; $i < 10; $i++) {
            $user 			= new User();
            $user->name 	= $faker->name;
            $user->email 	= $faker->unique()->safeEmail;
            $user->password = bcrypt('secret');
    		$user->profile  = 'Avatar.png';
            $user->save();
            $user->roles()->attach($role_user);
        }

        // Usuario por Defecto
        $user 			= new User();
        $user->name 	= 'Admin';
        $user->email 	= 'admin@gmail.com';
        $user->password = bcrypt('secret');
        $user->profile  = 'Avatar.png';	
        $user->save();
        $user->roles()->attach($role_admin);
    }
}
