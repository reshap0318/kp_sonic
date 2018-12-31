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
}
