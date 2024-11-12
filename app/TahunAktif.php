<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunAktif extends Model
{

    protected $table = 'tahun_aktif';
    protected $primaryKey = 'id_tahun';
    protected $fillable = ['tahun', 'status'];

    // Jika diperlukan, tambahkan relasi ke entitas lain
}

