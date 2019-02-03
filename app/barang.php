<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
  protected $table = 'barang';

  protected $fillable = [
    'no_serial',
    'th_perolehan',
    'id_jenis',
    'id_satker',
    'id_merek',
    'type',
    'kondisi',
    'keterangan',
    'status',
  ];

  public function jenis($value='')
  {
      return $this->hasOne(jenis::class,'id','id_jenis');
  }

  public function merek($value='')
  {
      return $this->hasOne(merek::class,'id','id_merek');
  }

  public function satker($value='')
  {
      return $this->hasOne(satker::class,'id','id_satker');
  }
}
