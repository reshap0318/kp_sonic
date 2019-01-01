<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventarisDetail extends Model
{
  protected $table = 'inventaris_details';

  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';

  protected $casts = [
     'kode'    => 'string',
     'kondisi'     => 'integer',
     'inventaris_id'     => 'integer',
  ];

  protected $fillable = [
    'kode',
    'kondisi',
    'inventaris_id',
  ];

  public function inventaris($value='')
  {
      return $this->hasOne(inventaris::class,'id','inventaris_id');
  }
}
