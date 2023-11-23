<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';

    protected $primaryKey = "kode_aset";

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';

    protected $fillable = [
        'kode_aset', 'nama', 'merk', 'tanggal', 'harga', 'nilai_residu', 'masa_manfaat', 'depresiasi', 'deskripsi', 'status', 'id_kategori', 'nomor_induk', 'tahun_1', 'tahun_2', 'tahun_3', 'tahun_4', 'vendor', 'img_url'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'nomor_induk', 'nomor_induk');
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
    public function history_pemakaian()
    {
        return $this->hasMany(HistoryPemakaian::class, 'kode_aset', 'kode_aset');
    }
    public function history_perbaikan()
    {
        return $this->hasMany(Perbaikan::class, 'kode_aset', 'kode_aset');
    }
    public function pemakaian()
    {
        return $this->hasOne(Pemakaian::class, 'kode_aset', 'kode_aset');
    }

    public function kantor()
     {
        return $this->belongsTo(Kantor::class, 'id_kantor', 'kota');
     }
}
