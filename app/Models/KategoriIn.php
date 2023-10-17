<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriIn extends Model
{
    use HasFactory;
    protected $table = "kategori_in";
    protected $fillable = [
        "nama_kategori"
    ];
}
