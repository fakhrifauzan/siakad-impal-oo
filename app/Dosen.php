<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'dosen';
  // protected $primaryKey = 'kode_dosen';

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
  * Get the user that owns the dosen.
  */
  public function user()
  {
      return $this->belongsTo('App\User', 'user_id', 'id');
  }

  public function jadwal()
  {
      return $this->hasMany('App\Jadwal', 'kode_dosen', 'kode_dosen');
  }

  public function kelas(){
      return $this->hasMany('App\Kelas', 'doswal', 'kode_dosen');
  }
}
