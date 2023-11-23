<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = "kategori";

    protected $primaryKey = "id_kategori";
    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_kategori', 'nama'
    ];

    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'id_kategori', 'id_kategori');
    }
}
