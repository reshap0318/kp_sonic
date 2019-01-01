<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventaris extends Model
{
  protected $table = 'inventaris';

  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';

  protected $casts = [
     'jenis'    => 'string',
     'polres_id'     => 'integer',
  ];

  protected $fillable = [
    'jenis',
    'Polres_id',
  ];

  public function polres($value='')
  {
      return $this->hasOne(polres::class,'id','polres_id');
  }

  public function detail($value='')
  {
      return $this->hasMany(inventarisDetail::class,'inventaris_id','id');
  }
}
