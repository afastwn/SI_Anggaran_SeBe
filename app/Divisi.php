<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{

    protected $table = 'divisi';
    protected $primaryKey = 'id_divisi';
    protected $fillable = ['nama_divisi', 'id_user'];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(Userr::class, 'id_user');
    }
}

