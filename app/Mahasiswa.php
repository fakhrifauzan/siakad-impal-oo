<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'mahasiswa';

  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public $timestamps = false;

  /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
  protected $guarded = [];

  /**
  * Get the user that owns the mahasiswa.
  */
  public function user()
  {
      return $this->belongsTo('App\User', 'user_id', 'id');
  }

  public function kelas(){
      return $this->hasOne('App\Kelas', 'kode_kelas', 'kode_kelas');
  }
}
