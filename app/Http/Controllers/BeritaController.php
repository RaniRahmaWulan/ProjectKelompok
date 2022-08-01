<?php

namespace App\Http\Controllers;

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

        $wali = new Wali();
        $wali->nama = $request->nama;
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/wali/', $name);
            $wali->foto = $name;
        }
        $wali->id_siswa = $request->id_siswa;
        $wali->save();
        return redirect()->route('wali.index')
            ->with('success', 'Data berhasil dibuat!');
    }

    public function show($id)
    {
        $wali = Wali::findOrFail($id);
        return view('wali.show', compact('wali'));
    }

    public function edit($id)
    {
        $wali = Wali::findOrFail($id);
        $siswa = Siswa::all();
        return view('wali.edit', compact('wali', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'id_siswa' => 'required',
            'foto' => 'image|max:2048',
        ]);

        $wali = Wali::findOrFail($id);
        $wali->nama = $request->nama;
        if ($request->hasFile('foto')) {
            $wali->deleteImage(); //menghapus foto sebelum di update melalui method deleteImage di model
            $image = $request->file('foto');
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/wali/', $name);
            $wali->foto = $name;
        }
        $wali->id_siswa = $request->id_siswa;
        $wali->save();
        return redirect()->route('wali.index')
            ->with('success', 'Data berhasil dibuat!');
    }

    public function destroy($id)
    {
        $wali = Wali::findOrFail($id);
        $wali->deleteImage();
        $wali->delete();
        return redirect()->route('wali.index')
            ->with('success', 'Data berhasil dihapus!');

    }
}