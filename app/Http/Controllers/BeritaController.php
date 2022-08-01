<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // memanggil data Berita bersama dengan data kategori
        // yang dibuat dari method 'kategori' di model 'Berita'
        $berita = Berita::with('kategori')->get();
        // dd($berita);
        // return $berita;
        return view('berita.index', ['berita' => $berita]);
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('berita.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|unique:walis',
            'judul' => 'required',
            'desc_berita' => 'required',
            'detail_berita' => 'required',
            'nama_pembuat' => 'required',
            'tgl_dibuat' => 'required',
            'gambar' => 'required|image|max:2048',
        ]);

        $berita = new Berita();
        $berita->judul = $request->judul;
        $berita->desc_berita = $request->desc_berita;
        $berita->detail_berita = $request->detail_berita;
        $berita->nama_pembuat = $request->nama_pembuat;
        $berita->tgl_dibuat = $request->tgl_dibuat;
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/berita/', $name);
            $berita->gambar = $name;
        }
        $berita->id_kategori = $request->id_kategori;
        $berita->save();
        return redirect()->route('berita.index')
            ->with('success', 'Data berhasil dibuat!');
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.show', compact('berita'));
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $kategori = Kategori::all();
        return view('berita.edit', compact('berita', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|unique:walis',
            'judul' => 'required',
            'desc_berita' => 'required',
            'detail_berita' => 'required',
            'nama_pembuat' => 'required',
            'tgl_dibuat' => 'required',
            'gambar' => 'required|image|max:2048',
        ]);

        $berita = Berita::findOrFail($id);
        $berita->judul = $request->judul;
        $berita->desc_berita = $request->desc_berita;
        $berita->detail_berita = $request->detail_berita;
        $berita->nama_pembuat = $request->nama_pembuat;
        $berita->tgl_dibuat = $request->tgl_dibuat;
        if ($request->hasFile('gambar')) {
            $berita->deleteImage(); //menghapus gambar sebelum di update melalui method deleteImage di model
            $image = $request->file('gambar');
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/berita/', $name);
            $berita->gambar = $name;
        }
        $berita->id_kategori = $request->id_kategori;
        $berita->save();
        return redirect()->route('berita.index')
            ->with('success', 'Data berhasil dibuat!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->deleteImage();
        $berita->delete();
        return redirect()->route('berita.index')
            ->with('success', 'Data berhasil dihapus!');

    }
}