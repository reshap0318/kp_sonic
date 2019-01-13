<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rekapPanggilan extends Model
{
  protected $table = 'rekap_panggilans';

  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';

  protected $casts = [
    'piket'                      => 'array',
    'panggilan_terselesaikan'    => 'integer',
    'panggilan_prank'            => 'integer',
    'panggilan_tidak_terjawab'   => 'integer',
    'polres_id'                  => 'integer',
    'user_id'                  => 'integer',
  ];

  protected $fillable = [
    'tanggal',
    'piket',
    'panggilan_terselesaikan',
    'panggilan_prank',
    'panggilan_tidak_terjawab',
    'polres_id',
    'user_id',
  ];

  public function polres($value='')
  {
      return $this->hasOne(polres::class,'id','polres_id');
  }

  public function user($value='')
  {
      return $this->hasOne(User::class,'id','user_id');
  }
}
