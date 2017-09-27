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
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'nama', 'deskripsi', 'tanggal_keluar'
  ];

  /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
  protected $guarded = [];
}
