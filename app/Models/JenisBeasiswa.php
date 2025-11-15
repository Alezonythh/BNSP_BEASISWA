<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisBeasiswa extends Model
{
    use HasFactory;

    protected $table = 'jenis_beasiswa';

    protected $fillable = [
        'nama',
        'minimal_ipk',
    ];

    /**
     * Relasi ke semua pendaftaran yang memilih jenis beasiswa ini.
     */
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
