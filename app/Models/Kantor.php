<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kantor extends Model
{
    use HasFactory;
    protected $table = "kantor";

    protected $primaryKey = "id_kantor";

    protected $fillable = [
        'kota', 'kecamatan', 'alamat', 'telepon'
    ];

    public function Ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id', 'id');
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'kode_aset', 'ruangan');
    }
}
