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

    	$login = Permission::firstOrCreate([
    		'name' => 'Login',
    		'slug' => 'login'
    	]);
    	$editroles = Permission::firstOrCreate([
    		'name' => 'Edit users',
    		'slug' => 'edit_users'
    	]);
    	$editdepartments = Permission::firstOrCreate([
    		'name' => 'Edit departments',
    		'slug' => 'edit_departments'
    	]);

		$userrole = Role::firstOrCreate([
			'name' => 'user',
			'description' => 'Regular user'
		]);
		$adminrole = Role::firstOrCreate([
			'name' => 'admin',
			'description' => 'Admin user'
		]);
		$superadminrole = Role::firstOrCreate([
			'name' => 'superadmin',
			'description' => 'Superadmin user'
		]);

		$login->roles()->attach($userrole);
		$adminrole->permissions()->attach($login->id);
		$superadminrole->permissions()->attach($login->id);
		$superadminrole->permissions()->attach($editroles->id);
		$superadminrole->permissions()->attach($editdepartments->id);

		$devs = Department::firstOrCreate([
			'name' => 'Development'
		]);
		
		$user = User::updateOrCreate([
			'name' => 'daniel',
			'email' => 'saktomail@gmail.com',
			'password' => bcrypt('danielv')
		]);
		$user->roles()->attach($login);
		$user->roles()->attach($adminrole);
		$user->roles()->attach($superadminrole);
		$user->departments()->attach($devs);
    }
}

