<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Buku extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pengarang()
    {
        return $this->belongsTo(Pengarang::class);
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class);
    }
    public function rak()
    {
        return $this->belongsTo(Rak::class);
    }
    public function tahun_terbit()
    {
        return $this->belongsTo(Tahun_terbit::class);
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
