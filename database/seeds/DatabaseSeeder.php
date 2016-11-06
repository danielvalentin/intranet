<?php

use Illuminate\Database\Seeder;

use App\Http\Models\Role;
use App\Http\Models\Permission;
use App\Http\Models\Department;
use App\Http\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$login = Permission::create([
    		'name' => 'login'
    	]);

		$userrole = Role::create([
			'name' => 'user',
			'description' => 'Regular user'
		]);
		$adminrole = Role::create([
			'name' => 'admin',
			'description' => 'Admin user'
		]);
		$superadminrole = Role::create([
			'name' => 'superadmin',
			'description' => 'Superadmin user'
		]);

		$login->roles()->attach($userrole);
		$adminrole->permissions()->attach($login->id);
		$superadminrole->permissions()->attach($login->id);

		$devs = Department::create([
			'name' => 'Development'
		]);
		
		$user = User::create([
			'name' => 'daniel',
			'email' => 'saktomail@gmail.com',
			'password' => bcrypt('danielv')
		]);
		$user->roles()->attach($login);
		$user->roles()->attach($adminrole);
		$user->departments()->attach($devs);
    }
}

