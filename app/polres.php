<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class polres extends Model
{
  protected $table = 'polres';

  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';

  protected $casts = [
     'nama'    => 'string',
     'email'     => 'string',
     'alamat'     => 'string',
  ];

  protected $fillable = [
    'nama',
    'email',
    'alamat',
  ];

  public function user($value='')
  {
      return $this->belongsTo(App\User);
  }

  public function laporan($value='')
  {
      return $this->hasOne(rekapPanggilan::class,'polres_id','id');
  }

  public function operator($value='')
  {
      return $this->hasMany(operator::class,'polres_id','id');
  }
}
