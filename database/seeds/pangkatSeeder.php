<?php

use Illuminate\Database\Seeder;

class pangkatSeeder extends Seeder
{

    public function run()
    {
        DB::table('pangkat')->insert([
          [
              'nama'		     => 'Brigadir Polisi Dua (BRIPDA)',
          ],[
              'nama'		     => 'Brigadir Polisi Satu (BRIPTU)',
          ],[
              'nama'		     => 'BRIGADIR',
          ],[
              'nama'		     => 'Brigadir Polisi Kepala (BRIPKA),',
          ],[
              'nama'		     => 'Ajun Inspektur Dua (AIPDA),',
          ],[
              'nama'		     => 'Ajun Inspektur Satu (AIPTU)',
          ],[
              'nama'		     => 'Inspektur Polisi Dua (IPDA)',
          ],[
              'nama'		     => 'Inspektur Polisi Satu (IPTU)',
          ],[
              'nama'		     => 'AKP',
          ],[
              'nama'		     => 'Komisaris Polisi (KOMPOL)',
          ],[
              'nama'		     => 'Ajun Komisaris Besar Polisi (AKBP)',
          ],[
              'nama'		     => 'Komisaris Besar Polisi (KOMBES)',
          ],[
              'nama'		     => 'Brigadir Jenderal Polisi (BRIGJEN)',
          ],[
              'nama'		     => 'Inspektur Jenderal Polisi (IRJEN)',
          ],[
              'nama'		     => 'Komisaris Jenderal Polisi (KOMJEN)',
          ],[
              'nama'		     => 'Jenderal Polisi',
          ]
        ]);
    }
}
