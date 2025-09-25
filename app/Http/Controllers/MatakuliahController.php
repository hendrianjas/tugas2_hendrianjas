<?php

namespace App\Http\Controllers;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{

    //menampilkan form untuk membuat Matakuliah baru
    public function create()
    {
        return view('matakuliah.create');
    }

    //menyimpan data matakuliah baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_mk' => 'required|string|max:255',
            'kode_mk' => 'required|string|max:20|unique:matakuliahs,kode_mk|max:13',
            'sks' => 'required|integer|max:5',
            'semester' => 'required|integer|max:5',
        ]);

        //simpan data ke database
        Matakuliah::create($request->all());

        //redirect ke halaman index dengan pesan sukses
        return redirect()->route('mahasiswa.index')
        ->with('success_matakuliah', 'Data Matakuliah berhasil ditambahkan!')
        ->with('active_tab', 'matakuliah'); // <- tetap buka tab matakuliah
    }
    
    public function edit(Matakuliah $matakuliah)
    {
        return view('matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, Matakuliah $matakuliah)
    {
    $request->validate([
        'nama_mk' => 'required',
        'kode_mk' => 'required',
        'sks' => 'required',
        'semester' => 'required',
    ]);

    $matakuliah->update($request->all());

        return redirect()->route('mahasiswa.index')
                     ->with('success_matakuliah', 'Data Matakuliah berhasil diupdate')
                     ->with('active_tab', 'matakuliah'); // <- tetap buka tab matakuliah
    }
    
    public function destroy(Matakuliah $matakuliah)
    {
    $matakuliah->delete();
    return redirect()->route('mahasiswa.index')
    ->with('success_matakuliah', 'Data Matakuliah berhasil dihapus')
    ->with('active_tab', 'matakuliah'); // <- tetap buka tab matakuliah
    }

}
