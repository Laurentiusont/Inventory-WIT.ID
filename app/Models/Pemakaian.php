<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    use HasFactory;

    protected $table = "pemakaian";

    protected $primaryKey = "id";

    protected $fillable = [
        'kode_aset', 'nomor_induk', 'id_ruangan'
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'kode_aset', 'kode_aset');
    }
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan', 'id_ruangan');
    }
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'nomor_induk', 'nomor_induk');
    }
}
