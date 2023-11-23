<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $primaryKey = "nomor_induk";

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';

    protected $fillable = [
        'nomor_induk', 'gambar', 'nama', 'gender', 'email', 'telepon', 'jabatan', 'divisi', 'alamat', 'img_url'
    ];

    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'nomor_induk', 'nomor_induk');
    }
    public function pemakaian()
    {
        return $this->hasMany(Pemakaian::class, 'nomor_induk', 'nomor_induk');
    }
    public function perbaikan()
    {
        return $this->hasMany(Perbaikan::class, 'id', 'id');
    }
}
