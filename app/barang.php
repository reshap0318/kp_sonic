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
    'id_merek',
    'type',
    'kondisi',
    'keterangan',
    'id_user',
  ];

  public function jenis($value='')
  {
      return $this->hasOne(jenis::class,'id','id_jenis');
  }

  public function merek($value='')
  {
      return $this->hasOne(merek::class,'id','id_merek');
  }

  public function user($value='')
  {
      return $this->hasOne(user::class,'id','id_user');
  }
}
