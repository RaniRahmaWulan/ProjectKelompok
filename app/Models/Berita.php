<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    // membuat relasi one to one di model
    public function kategori()
    {
        // data dari model 'Berita' bisa dimiliki
        // oleh model 'kategori' melalui 'id_kategori'
        return $this->hasOne(Kategori::class, 'id_kategori');
    }

    // method menampilkan image(foto)
    public function image()
    {
        if ($this->foto && file_exists(public_path('images/berita/' . $this->foto))) {
            return asset('images/berita/' . $this->foto);
        } else {
            return asset('images/no_image.jpg');
        }
    }
    // mengahupus image(foto) di storage(penyimpanan) public
    public function deleteImage()
    {
        if ($this->foto && file_exists(public_path('images/berita/' . $this->foto))) {
            return unlink(public_path('images/berita/' . $this->foto));
        }
    }
}