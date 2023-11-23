<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPemakaian extends Model
{
    use HasFactory;
    protected $table = "history_pemakaian";

    protected $primaryKey = "id";

    protected $fillable = [
        'nomor_induk_old', 'nomor_induk_new', 'tanggal', 'ruangan_old', 'ruangan_new', 'kode_aset'
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'kode_aset', 'kode_aset');
    }
}
