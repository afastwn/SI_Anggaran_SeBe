<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Userr extends Authenticatable
{

    protected $table = 'userr';
    protected $primaryKey = 'id_user';
    protected $fillable = ['nama_user', 'role', 'email'];

    // Jika ada relasi dengan entitas lain, tambahkan di sini
}

