<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengembalian extends Model
{
  protected $table = 'pengembalian';

  protected $fillable = [
    'tanggal',
    'peminjaman_id',
    'nrp_nip',
    'keterangan',
    'kondisi',
  ];

  public function peminjaman($value='')
  {
      return $this->hasOne(peminjaman::class,'id','peminjaman_id');
  }

  public function user($value='')
  {
      return $this->hasOne(User::class,'nrp_nip','nrp_nip');
  }

}
