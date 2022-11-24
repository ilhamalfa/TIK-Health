<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    // Hanya ID yang boleh diisi
    protected $guarded = ['id'];

    // fungsi untuk relasi ke model kategori (1 to N)
    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    // fungsi untuk relasi ke model user (1 to N)
    public function user(){
        return $this->belongsTo(User::class);
    }
}
