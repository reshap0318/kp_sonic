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
                'nama'		     => 'POLDA PADANG',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => 'PADANG'
            ],[
                'nama'		     => 'POLRESTA PADANG',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => 'Jl. M.Yamin SH No 1 Padang'
            ],[
                'nama'		     => 'POLRES PESISIR SELATAN',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => 'Jl. H Agus Salim'
            ],[
                'nama'		     => 'POLRES PASAMAN TIMUR',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => 'Jl. Jenderal Sudirman No. 25 Lubuk Sikaping'
            ],[
                'nama'		     => 'POLRES SIJUNJUNG',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => 'Jl. Jenderal Sudirman Muaro Sijunjung'
            ],[
                'nama'		     => 'POLRES SOLOK KOTA',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => 'Jl. KS. Tubun No.2 Solok'
            ],[
                'nama'		     => 'POLRES AGAM',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => 'Jl.Jend Sudirman Lubuk Basung'
            ],[
                'nama'		     => 'POLRES Kep. MENTAWAI',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => 'KM.9 Tua Pejat Kec.Sipora Utara Kab.Kep.Mentawai'
            ],[
                'nama'		     => 'POLRES PASAMAN BARAT',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => 'jl. Soekarno Hatta No 60 Kec. Pasaman Kab. Pasaman'
            ],[
                'nama'		     => 'POLRES LIMAPULUH KOTA',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => 'Jl. Raya Tanjung Pati KM. 8 Harau '
            ],[
                'nama'		     => 'POLRESTA PAYAKUMBUH',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => 'Jl Pahlawan No. 33 Payakumbuh'
            ],[
                'nama'		     => 'POLRESTA BUKITTINGGI',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => 'Jln Sudirman No. 23'
            ],[
                'nama'		     => 'POLRES PADANG PARIAMAN',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => 'Jalan Padang Baru 10 Parit Malintang'
            ],[
                'nama'		     => 'POLRES TANAH DATAR',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => 'Jl. Sutan Alam Bagagarsyah, Pagaruyung Kec. Tanjung Emas Kab. Tanah Datar'
            ],[
                'nama'		     => 'POLRES PARIAMAN',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => ' Jl. Imam Bonjol Pariaman No. 37 Pariaman'
            ],[
                'nama'		     => 'POLRES PADANG PANJANG',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => 'Jl. Kaharuddin Dt. Rangkayo Basa 3 Padang Panjang'
            ],[
                'nama'		     => 'POLRESTA SAWAH LUNTO',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => 'Jalan Adam Malik Nomor 10 Sawahlunto'
            ],[
                'nama'		     => 'POLRES DHARMAS RAYA',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => 'Jl. Lintas Sumatra Km 200 Gunung Medan Kec. Sitiung'
            ],[
                'nama'		     => 'POLRES SOLOK AROSUKA',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => 'Jl. Lintas Sumatra Lb. Selasih Kec. Gunung Talang'
            ],[
                'nama'		     => 'POLRES SOLOK SELATAN',
                'email' 		   => 'polres.email@padang.com',
                'alamat' 		 => 'Jl. Padang Aro-Kerinci Km2 Kec.Sangir Kab.Solsel'
            ]
         ]);


         DB::table('users')->insert([
           [
 			    		'username'		 => 'admin',
 			    		'password' 		 => bcrypt('admin'),
 			    		'permissions'  => '{"home.dashboard":true}',
               'kode'         => 'Admin',
 			    		'QRpassword'	 => 'Dammy-CODE-1S4u7lJzehk62xDm3DgYgXXYWtbHE6gSP'
 			    ],[
			    		'username'		 => 'bidit',
			    		'password' 		 => bcrypt('bidit'),
			    		'permissions'  => '{"home.dashboard":true}',
              'kode'         => 'Bidang IT Polda',
			    		'QRpassword'	 => 'Dammy-CODE-1S4u7lJzehk62xDm3DgYgXXYWtbHE6gSP'
			    ]
        ]);
         DB::table('roles')->insert([
			    [
			    		'id'=>'1',
			    		'slug' 		    => 'admin',
			    		'name' 			  => 'Admin',
			    		'permissions' => '{"password.request":true,"password.email":true,"password.reset":true,"home.dashboard":true,"user.index":true,"user.create":true,"user.store":true,"user.show":true,"user.edit":true,"user.update":true,"user.destroy":true,"user.activate":true,"user.deactivate":true,"user.permissions":true,"user.simpan":true,"role.index":true,"role.create":true,"role.store":true,"role.show":true,"role.edit":true,"role.update":true,"role.destroy":true,"role.permissions":true,"role.simpan":true}',
			    ],[
			    		'id'=>'2',
			    		'slug' 		    => 'BID IT',
			    		'name' 			  => 'BID IT',
			    		'permissions' => '{"password.request":true,"password.email":true,"password.reset":true,"home.dashboard":true,"user.index":true,"user.create":true,"user.store":true,"user.show":true,"user.edit":true,"user.update":true,"user.destroy":true,"user.activate":true,"user.deactivate":true,"user.permissions":true,"user.simpan":true,"role.index":true,"role.create":true,"role.store":true,"role.show":true,"role.edit":true,"role.update":true,"role.destroy":true,"role.permissions":true,"role.simpan":true}',
			    ]
        ]);
		 DB::table('role_users')->insert([
			    [
			    		'user_id' 		=> '1',
			    		'role_id' 			=> '1',
			    ],[
			    		'user_id' 		=> '2',
			    		'role_id' 			=> '2',
			    ]
        ]);
		 DB::table('activations')->insert([
			    [
			    		'user_id' 		=> '1',
			    		'code' 			=> '1S4u7lJzehk62xDm3DgYgXXYWtbHE6gSP',
			    		'completed' 			=> '1',
			    ],
          [
			    		'user_id' 		=> '2',
			    		'code' 			=> 'KJeB6LCXzhC6ZMUpvAMeGAUxmolnVRt3',
			    		'completed' 			=> '1',
			    ]
        ]);
    }
}
