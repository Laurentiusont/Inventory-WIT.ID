<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = "ruangan";

    protected $primaryKey = "id_ruangan";

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'nama', 'lantai', 'id_kantor'
    ];

    public function pemakaian()
    {
        return $this->belongsTo(Pemakaian::class, 'id_ruangan', 'id_ruangan');
    }
    public function kantor()
    {
        return $this->hasMany(Kantor::class, 'id_kantor', 'id_kantor');
    }

    public function tempat()
    {
        return $this->belongsTo(Kantor::class, 'id_kantor', 'id_kantor');
    }
}
