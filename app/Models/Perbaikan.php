<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    use HasFactory;

    protected $table = "history_perbaikan";

    protected $primaryKey = "id";

    protected $fillable = [
        'tanggal_perbaikan', 'biaya', 'deskripsi', 'tanggal_kerusakan', 'tanggal_selesai_perbaikan', 'kode_aset', 'pemakai_terakhir', 'tempat_perbaikan', 'karyawan_perbaikan'
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'kode_aset', 'kode_aset');
    }

    public function karyawan_perbaiki()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_perbaikan', 'nomor_induk', 'nama');
    }
    public function karyawan_pemakai()
    {
        return $this->belongsTo(Karyawan::class, 'pemakai_terakhir', 'nomor_induk', 'nama');
    }
}
