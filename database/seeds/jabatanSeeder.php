<?php

use Illuminate\Database\Seeder;

class jabatanSeeder extends Seeder
{

    public function run()
    {
        DB::table('jabatan')->insert([
          [
              'nama'		     => 'Kapolda',
          ],[
              'nama'		     => 'Kapolres',
          ],[
              'nama'		     => 'Kapolsek',
          ],[
              'nama'		     => 'Anggota',
          ]
        ]);
    }
}
