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
                'nama'		     => 'POLDA SUMBAR',
                'email' 		   => '(0751) 8950779',
                'alamat' 		 => 'PADANG'
            ],[
                'nama'		     => 'POLRESTA PADANG',
                'email' 		   => '0751-22317',
                'alamat' 		 => 'Jl. M.Yamin SH No 1 Padang'
            ],[
                'nama'		     => 'POLRES PESISIR SELATAN',
                'email' 		   => '0756-21110/21010',
                'alamat' 		 => 'Jl. H Agus Salim'
            ],[
                'nama'		     => 'POLRES PASAMAN TIMUR',
                'email' 		   => '0753-20010',
                'alamat' 		 => 'Jl. Jenderal Sudirman No. 25 Lubuk Sikaping'
            ],[
                'nama'		     => 'POLRES SIJUNJUNG',
                'email' 		   => '0754-20004',
                'alamat' 		 => 'Jl. Jenderal Sudirman Muaro Sijunjung'
            ],[
                'nama'		     => 'POLRES SOLOK KOTA',
                'email' 		   => '0755-21110',
                'alamat' 		 => 'Jl. KS. Tubun No.2 Solok'
            ],[
                'nama'		     => 'POLRES AGAM',
                'email' 		   => '0752–76135',
                'alamat' 		 => 'Jl.Jend Sudirman Lubuk Basung'
            ],[
                'nama'		     => 'POLRES Kep. MENTAWAI',
                'email' 		   => '0759-320310',
                'alamat' 		 => 'KM.9 Tua Pejat Kec.Sipora Utara Kab.Kep.Mentawai'
            ],[
                'nama'		     => 'POLRES PASAMAN BARAT',
                'email' 		   => '0753-7464151',
                'alamat' 		 => 'jl. Soekarno Hatta No 60 Kec. Pasaman Kab. Pasaman'
            ],[
                'nama'		     => 'POLRES LIMAPULUH KOTA',
                'email' 		   => '0753-7464151',
                'alamat' 		 => 'Jl. Raya Tanjung Pati KM. 8 Harau '
            ],[
                'nama'		     => 'POLRESTA PAYAKUMBUH',
                'email' 		   => '0752-92110',
                'alamat' 		 => 'Jl Pahlawan No. 33 Payakumbuh'
            ],[
                'nama'		     => 'POLRESTA BUKITTINGGI',
                'email' 		   => '0752-22530',
                'alamat' 		 => 'Jln Sudirman No. 23'
            ],[
                'nama'		     => 'POLRES PADANG PARIAMAN',
                'email' 		   => '0751-676100',
                'alamat' 		 => 'Jalan Padang Baru 10 Parit Malintang'
            ],[
                'nama'		     => 'POLRES TANAH DATAR',
                'email' 		   => '0752-71310',
                'alamat' 		 => 'Jl. Sutan Alam Bagagarsyah, Pagaruyung Kec. Tanjung Emas Kab. Tanah Datar'
            ],[
                'nama'		     => 'POLRES PARIAMAN',
                'email' 		   => '0751-93608/92619',
                'alamat' 		 => ' Jl. Imam Bonjol Pariaman No. 37 Pariaman'
            ],[
                'nama'		     => 'POLRES PADANG PANJANG',
                'email' 		   => '0752-82110',
                'alamat' 		 => 'Jl. Kaharuddin Dt. Rangkayo Basa 3 Padang Panjang'
            ],[
                'nama'		     => 'POLRESTA SAWAH LUNTO',
                'email' 		   => '0754-62423',
                'alamat' 		 => 'Jalan Adam Malik Nomor 10 Sawahlunto'
            ],[
                'nama'		     => 'POLRES DHARMAS RAYA',
                'email' 		   => '0754-558110',
                'alamat' 		 => 'Jl. Lintas Sumatra Km 200 Gunung Medan Kec. Sitiung'
            ],[
                'nama'		     => 'POLRES SOLOK AROSUKA',
                'email' 		   => '0755-7334062',
                'alamat' 		 => 'Jl. Lintas Sumatra Lb. Selasih Kec. Gunung Talang'
            ],[
                'nama'		     => 'POLRES SOLOK SELATAN',
                'email' 		   => '0755-583353',
                'alamat' 		 => 'Jl. Padang Aro-Kerinci Km2 Kec.Sangir Kab.Solsel'
            ]
         ]);


         DB::table('users')->insert([
           [
 			    		'username'		 => 'admin',
 			    		'password' 		 => bcrypt('admin'),
 			    		'permissions'  => '{"password.request":true,"password.email":true,"password.reset":true,"home.dashboard":true,"user.index":true,"user.create":true,"user.store":true,"user.show":true,"user.edit":true,"user.update":true,"user.destroy":true,"user.activate":true,"user.deactivate":true,"user.permissions":true,"user.simpan":true,"role.index":true,"role.create":true,"role.store":true,"role.show":true,"role.edit":true,"role.update":true,"role.destroy":true,"role.permissions":true,"role.simpan":true,"polres.index":true,"polres.show":true,"panggilan.index":true,"panggilan.show":true,"inventaris.index":true,"inventaris.show":true,"inventaris_detail.index":true,"inventaris_detail.show":true,"operator.index":true,"operator.show":true}',
               'nama'         => 'Admin',
 			    		'QRpassword'	 => 'Dammy-CODE-1S4u7lJzehk62xDm3DgYgXXYWtbHE6gSP'
 			    ],[
			    		'username'		 => 'bidti',
			    		'password' 		 => bcrypt('bidti'),
			    		'permissions'  => '{"home.dashboard":true}',
              'nama'         => 'Bidang IT Polda (ADMIN)',
			    		'QRpassword'	 => 'Dammy-CODE-1S4u7lJzehk62xDm3DgYgXXYWtbHE6gSP'
			    ]
        ]);
         DB::table('roles')->insert([
           [
 			    		'id'=>'1',
 			    		'slug' 		    => 'eos',
 			    		'name' 			  => 'EOS (Engenering On Site)',
 			    		'permissions' => '{"password.request":true,"password.email":true,"password.reset":true,"home.dashboard":true,"user.index":true,"user.create":true,"user.store":true,"user.show":true,"user.edit":true,"user.update":true,"user.destroy":true,"polres.index":true,"polres.create":true,"polres.store":true,"polres.show":true,"polres.edit":true,"polres.update":true,"polres.destroy":true,"panggilan.index":true,"panggilan.create":true,"panggilan.store":true,"panggilan.show":true,"panggilan.edit":true,"panggilan.update":true,"panggilan.destroy":true,"inventaris.index":true,"inventaris.create":true,"inventaris.store":true,"inventaris.show":true,"inventaris.edit":true,"inventaris.update":true,"inventaris.destroy":true,"inventaris_detail.index":true,"inventaris_detail.create":true,"inventaris_detail.store":true,"inventaris_detail.show":true,"inventaris_detail.edit":true,"inventaris_detail.update":true,"inventaris_detail.destroy":true,"operator.index":true,"operator.create":true,"operator.store":true,"operator.show":true,"operator.edit":true,"operator.update":true,"operator.destroy":true,"operator.aktiv":true}',
 			    ],
			    [
			    		'id'=>'2',
			    		'slug' 		    => 'BID IT (ADMIN)',
			    		'name' 			  => 'BID IT (ADMIN)',
			    		'permissions' => '{"home.dashboard":true,"polres.index":true,"polres.show":true,"panggilan.index":true,"panggilan.create":true,"panggilan.store":true,"panggilan.show":true,"panggilan.edit":true,"panggilan.update":true,"panggilan.destroy":true,"inventaris.index":true,"inventaris.create":true,"inventaris.store":true,"inventaris.show":true,"inventaris.edit":true,"inventaris.update":true,"inventaris.destroy":true,"inventaris_detail.index":true,"inventaris_detail.create":true,"inventaris_detail.store":true,"inventaris_detail.show":true,"inventaris_detail.edit":true,"inventaris_detail.update":true,"inventaris_detail.destroy":true,"operator.index":true,"operator.create":true,"operator.store":true,"operator.show":true,"operator.edit":true,"operator.update":true,"operator.destroy":true,"operator.aktiv":true}',
			    ]
          // ,[
			    // 		'id'=>'3',
			    // 		'slug' 		    => 'kapolres',
			    // 		'name' 			  => 'Kapolres',
			    // 		'permissions' => '{"home.dashboard":true,"polres.index":true,"polres.show":true,"panggilan.index":true,"panggilan.show":true,"inventaris.index":true,"inventaris.show":true,"inventaris_detail.index":true,"inventaris_detail.show":true}',
			    // ]
        ]);
		 DB::table('role_users')->insert([
          [
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
