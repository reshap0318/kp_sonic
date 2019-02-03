<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
      'pemberi_id',
      'tanggal',
      'barang_id',
      'nrp_nip',
      'keterangan',
      'kondisi',
    ];

    public function barang($value='')
    {
        return $this->hasOne(barang::class,'id','barang_id');
    }

    public function user($value='')
    {
        return $this->hasOne(User::class,'nrp_nip','nrp_nip');
    }

    public function pemberi($value='')
    {
        return $this->hasOne(User::class,'id','pemberi_id');
    }

}
