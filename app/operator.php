<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class operator extends Model
{
  protected $table = 'operators';

  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';

  protected $casts = [
     'nama'    => 'string',
     'no_sk'     => 'string',
     'foto_sk'    => 'string',
     'aktivasi'     => 'integer',
     'polres_id'     => 'integer',
  ];

  protected $fillable = [
    'nama',
    'no_sk',
    'foto_sk',
    'aktivasi',
    'polres_id',
  ];

  public function polres($value='')
  {
      return $this->hasOne(polres::class,'id','polres_id');
  }
}
