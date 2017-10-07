<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     /**
     * Get the phone record associated with the mahasiswa and dosen.
     */
     public function mahasiswa()
     {
        return $this->hasOne('App\Mahasiswa', 'user_id', 'id');
     }

     public function dosen()
     {
         return $this->hasOne('App\Dosen', 'user_id', 'id');
     }
}
