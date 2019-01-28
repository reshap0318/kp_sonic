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
          DB::table('satker')->insert([
            [
                'nama'		     => 'POLDA SUMBAR',
            ]
         ]);

           DB::table('pangkat')->insert([
             [
                 'nama'		     => 'Bintang 3',
             ]
          ]);

            DB::table('jabatan')->insert([
              [
                  'nama'		     => 'Kapolda',
              ]
           ]);


         DB::table('users')->insert([
           [
 			    		'nrp_nip'		 => 'admin',
 			    		'password' 		 => bcrypt('admin'),
 			    		'permissions'  => '{"password.request":true,"password.email":true,"password.reset":true,"home.dashboard":true,"user.index":true,"user.create":true,"user.store":true,"user.show":true,"user.edit":true,"user.update":true,"user.destroy":true,"user.activate":true,"user.deactivate":true,"user.permissions":true,"user.simpan":true,"role.index":true,"role.create":true,"role.store":true,"role.show":true,"role.edit":true,"role.update":true,"role.destroy":true,"role.permissions":true,"role.simpan":true,"polres.index":true,"polres.show":true,"panggilan.index":true,"panggilan.show":true,"inventaris.index":true,"inventaris.show":true,"inventaris_detail.index":true,"inventaris_detail.show":true,"operator.index":true,"operator.show":true}',
               'nama'         => 'Admin',
               'satker_id'    => 1,
               'pangkat_id'   => 1,
               'jabatan_id'   => 1,
               'jenis_kelamin'   => 1,
 			    ]
        ]);
         DB::table('roles')->insert([
           [
 			    		'id'=>'1',
 			    		'slug' 		    => 'Admin',
 			    		'name' 			  => 'Admin',
              'permissions'  => '{"password.request":true,"password.email":true,"password.reset":true,"home.dashboard":true,"user.index":true,"user.create":true,"user.store":true,"user.show":true,"user.edit":true,"user.update":true,"user.destroy":true,"user.activate":true,"user.deactivate":true,"user.permissions":true,"user.simpan":true,"role.index":true,"role.create":true,"role.store":true,"role.show":true,"role.edit":true,"role.update":true,"role.destroy":true,"role.permissions":true,"role.simpan":true,"polres.index":true,"polres.show":true,"panggilan.index":true,"panggilan.show":true,"inventaris.index":true,"inventaris.show":true,"inventaris_detail.index":true,"inventaris_detail.show":true,"operator.index":true,"operator.show":true}',
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
