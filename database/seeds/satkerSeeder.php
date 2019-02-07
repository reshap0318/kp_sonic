<?php

use Illuminate\Database\Seeder;

class satkerSeeder extends Seeder
{

    public function run()
    {
        DB::table('satker')->insert([
          [
              'nama'		     => 'POLDA SUMBAR',
          ],[
              'nama'		     => 'POLRESTA PADANG',
          ],[
              'nama'		     => 'POLRES PESISIR SELATAN',
          ],[
              'nama'		     => 'POLRES PASAMAN TIMUR',
          ],[
              'nama'		     => 'POLRES SIJUNJUNG',
          ],[
              'nama'		     => 'POLRES SOLOK KOTA',
          ],[
              'nama'		     => 'POLRES AGAM',
          ],[
              'nama'		     => 'POLRES Kep. MENTAWAI',
          ],[
              'nama'		     => 'POLRES PASAMAN BARAT',
          ],[
              'nama'		     => 'POLRES LIMAPULUH KOTA',
          ],[
              'nama'		     => 'POLRESTA PAYAKUMBUH',
          ],[
              'nama'		     => 'POLRESTA BUKITTINGGI',
          ],[
              'nama'		     => 'POLRES PADANG PARIAMAN',
          ],[
              'nama'		     => 'POLRES TANAH DATAR',
          ],[
              'nama'		     => 'POLRES PARIAMAN',
          ],[
              'nama'		     => 'POLRES PADANG PANJANG',
          ],[
              'nama'		     => 'POLRESTA SAWAH LUNTO',
          ],[
              'nama'		     => 'POLRES DHARMAS RAYA',
          ],[
              'nama'		     => 'POLRES SOLOK AROSUKA',
          ],[
              'nama'		     => 'POLRES SOLOK SELATAN',
          ]
       ]);
    }
}
