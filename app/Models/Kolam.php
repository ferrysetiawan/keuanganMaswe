<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kolam extends Model
{
    use HasFactory;
    protected $table = 'kolam';
    protected $fillable = ['nama_kolam'];

    public function penjualan()
    {
        return $this->belongsToMany(Penjualan::class);
    }
}
