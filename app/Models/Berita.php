<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    // field apa saja yang bisa di isi
    public $fillable = ['judul','berita_detail','berita_singkat','nama_pembuat','tgl_dibuat','foto','id_kategori'];

    // membuat relasi one to one di model
    public function Kategori()
    {
        // data dari model 'Wali' bisa dimiliki
        // oleh model 'kategori' melalui 'id'
        return $this->belongsTo(Kategori::class, 'id');
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