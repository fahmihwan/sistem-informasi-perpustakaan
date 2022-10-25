<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }

    public function scopeFilter($query, array $filters)
    {
        return  $query->with([
            'buku:id,judul',
            'anggota:id,nama,role_id',
            'anggota.role:id,nama',
            'petugas:id,credential_id',
            'petugas.credential:id,nama',
        ])->whereDate('tanggal_pengembalian', '>=', $filters['start_date'])->whereDate('tanggal_pengembalian', '<=', $filters['end_date']);
    }
}
