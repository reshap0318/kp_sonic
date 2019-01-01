<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rekapPanggilan extends Model
{
  protected $table = 'rekap_panggilans';

  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';

  protected $casts = [
    'nama'    => 'string',
    'pangkat'     => 'string',
    'nrp'     => 'string',
    'panggilan_terjawab'    => 'integer',
    'panggilan_tidak_terjawab'     => 'integer',
    'polres_id'     => 'integer',
  ];

  protected $fillable = [
    'nama',
    'pangkat',
    'nrp',
    'panggilan_terjawab',
    'panggilan_tidak_terjawab',
    'polres_id',
  ];

  public function polres($value='')
  {
      return $this->hasOne(polres::class,'id','polres_id');
  }
}
