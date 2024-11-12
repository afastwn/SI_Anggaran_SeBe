<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    protected $table = 'anggaran';
    protected $primaryKey = 'id_anggaran';
    protected $fillable = ['nama_anggaran', 'tanggal', 'jumlah', 'status', 'id_rekening', 'id_divisi', 'id_tahun', 'id_pengajuan'];
    public $timestamps = false;
    // Relasi ke Pengajuan
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'id_pengajuan');
    }

    // Relasi ke Divisi
    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi');
    }

    // Relasi ke Rekening
    public function rekening()
    {
        return $this->belongsTo(Rekening::class, 'id_rekening');
    }

    // Relasi ke Tahun Aktif
    public function tahun()
    {
        return $this->belongsTo(TahunAktif::class, 'id_tahun');
    }
}
