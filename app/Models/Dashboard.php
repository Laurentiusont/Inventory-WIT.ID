<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;

    public function pemakaian()
    {
        return $this->belongsTo(Pemakaian::class, 'kode_aset', 'kode_aset');
    }
}