<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Hanya ID yang boleh diisi
    protected $guarded = ['id'];

    // fungsi untuk relasi ke model artikel (1 to N)
    public function artikel(){
        return $this->hasMany(Artikel::class);
    }
}
