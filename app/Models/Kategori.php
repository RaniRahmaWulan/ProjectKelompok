<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
     // field apa saja yang bisa di isi
     public $fillable = ['jenis_kategori'];
     // membuat fitur created_at(kapan data dibuat) & updated_at (kapan data diedit)
     // aktif
     public $timestamps = true;

    // membuat relasi one to one
    public function Berita()
    {
        // data dari model 'berita' bisa memiliki 1 data
        // dari model 'kategori' melalui id
        return $this->hasOne(Kategori::class, 'id');
    }
}
