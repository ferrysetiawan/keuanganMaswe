<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $fillable = [
        'tanggal',
        'pembeli',
        'kategori_id',
        'qty',
        'unit',
        'harga',
        'total'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriIn::class);
    }

    public function kolam()
    {
        return $this->belongsToMany(Kolam::class);
    }

    public function attachTags($kolam_id){
        $kolam = Kolam::find($kolam_id);
        return $this->kolam()->attach($kolam);
    }

    public function detachTags($kolam_id){
        $kolam = Kolam::find($kolam_id);
        return $this->kolam()->detach($kolam);
    }
}
