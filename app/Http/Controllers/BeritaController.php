<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // memanggil data berita bersama dengan data kategori
        // yang dibuat dari method 'kategori' di model 'berita'
        $berita = Berita::with('kategori')->get();
        // dd($berita);
        // return $berita;
        return view('berita.index', ['berita' => $berita]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('berita.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'berita_detail' => 'required',
            'berita_singkat' => 'required',
            'id_kategori' => 'required',
            'nama_pembuat' => 'required',
            'tgl_dibuat' => 'required',
            'foto' => 'required|image|max:2048',
        ]);

        $berita = new Berita();
        $berita->judul = $request->judul;
        $berita->berita_detail = $request->berita_detail;
        $berita->berita_singkat = $request->berita_singkat;
        $berita->id_kategori = $request->id_kategori;
        $berita->nama_pembuat = $request->nama_pembuat;
        $berita->tgl_dibuat = $request->tgl_dibuat;
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/berita/', $name);
            $berita->foto = $name;
        }
        $berita->save();
        return redirect()->route('berita.index')
            ->with('success', 'Data berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.show', compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $kategori = Kategori::all();
        return view('berita.edit', compact('berita', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'berita_detail' => 'required',
            'berita_singkat' => 'required',
            'id_kategori' => 'required',
            'nama_pembuat' => 'required',
            'tgl_dibuat' => 'required',
            'foto' => 'required|image|max:2048',
        ]);

        $berita = Berita::findOrFail($id);
        $berita->judul = $request->judul;
        $berita->berita_detail = $request->berita_detail;
        $berita->berita_singkat = $request->berita_singkat;
        $berita->id_kategori = $request->id_kategori;
        $berita->nama_pembuat = $request->nama_pembuat;
        $berita->tgl_dibuat = $request->tgl_dibuat;
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/berita/', $name);
            $berita->foto = $name;
        }
        $berita->save();
        return redirect()->route('berita.index')
            ->with('success', 'Data berhasil dibuat!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $berita = Berita::find($id);
        $foto = $berita->foto;

        if (!Berita::destroy($id)) {
            return redirect()->back();
        }
        if ($foto) {
            $berita->deleteImage();
        }
        return redirect()->route('berita.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}