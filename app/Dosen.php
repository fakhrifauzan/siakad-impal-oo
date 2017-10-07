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
}
