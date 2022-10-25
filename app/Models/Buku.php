<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function pengarang()
    {
        return $this->belongsTo(Pengarang::class)->withTrashed();
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class)->withTrashed();
    }
    public function rak()
    {
        return $this->belongsTo(Rak::class)->withTrashed();
    }
    public function tahun_terbit()
    {
        return $this->belongsTo(Tahun_terbit::class)->withTrashed();
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class)->withTrashed();
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
