<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table('polres')->insert([
           [
               'nama'		     => 'Polres Kota Padang',
               'email' 		   => 'polres.email@padang.com',
               'alamat' 		 => 'dipadang'
           ]
         ]);


         DB::table('users')->insert([
			    [
			    		'username'		 => 'admin',
			    		'password' 		 => bcrypt('admin'),
			    		'permissions'  => '{"home.dashboard":true}',
              'kode'         => 'Admin',
			    		'QRpassword'	 => 'Dammy-CODE-1S4u7lJzehk62xDm3DgYgXXYWtbHE6gSP'
			    ]
        ]);
         DB::table('roles')->insert([
			    [
			    		'id'=>'1',
			    		'slug' 		    => 'admin',
			    		'name' 			  => 'Admin',
			    		'permissions' => '{"password.request":true,"password.email":true,"password.reset":true,"home.dashboard":true,"user.index":true,"user.create":true,"user.store":true,"user.show":true,"user.edit":true,"user.update":true,"user.destroy":true,"user.activate":true,"user.deactivate":true,"user.permissions":true,"user.simpan":true,"role.index":true,"role.create":true,"role.store":true,"role.show":true,"role.edit":true,"role.update":true,"role.destroy":true,"role.permissions":true,"role.simpan":true}',
			    ]
        ]);
		 DB::table('role_users')->insert([
			    [
			    		'user_id' 		=> '1',
			    		'role_id' 			=> '1',
			    ]
        ]);
		 DB::table('activations')->insert([
			    [
			    		'user_id' 		=> '1',
			    		'code' 			=> '1S4u7lJzehk62xDm3DgYgXXYWtbHE6gSP',
			    		'completed' 			=> '1',
			    ]
        ]);
    }
}
