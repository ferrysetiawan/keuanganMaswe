<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $table = 'pembelian';
    protected $fillable = [
        'tanggal',
        'keterangan',
        'kategori_id',
        'total'];

    public function kategori()
    {
        return $this->belongsTo(KategoriOut::class);
    }
}
