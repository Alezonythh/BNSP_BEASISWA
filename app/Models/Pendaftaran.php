<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'semester',
        'ipk',
        'jenis_beasiswa_id',
        'file_path',
        'status_ajuan',
    ];

    /**
     * Relasi ke jenis beasiswa yang dipilih pendaftar.
     */
    public function jenisBeasiswa()
    {
        return $this->belongsTo(JenisBeasiswa::class);
    }
}
