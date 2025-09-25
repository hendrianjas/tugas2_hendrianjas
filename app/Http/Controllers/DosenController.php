<?php

namespace App\Http\Controllers;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{

    //menampilkan form untuk membuat dosen baru
    public function create()
    {
        return view('dosen.create');
    }

    //menyimpan data dosen baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nidn' => 'required|string|max:20|unique:dosens,nidn|max:13',
            'jabatan' => 'required|in:Dosen,Lektor,Guru Besar',
            'email' => 'required|string|max:255|unique:dosens,email|max:50',
            'telepon' => 'required|string|max:255',
        ]);

        //simpan data ke database
        Dosen::create($request->all());

        //redirect ke halaman index dengan pesan sukses
        return redirect()->route('mahasiswa.index')
                ->with('success_dosen', 'Data Dosen berhasil ditambahkan!')
                ->with('active_tab', 'dosen'); // <- tetap buka tab Dosen
    }
    
    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
    $request->validate([
        'nama' => 'required',
        'nidn' => 'required',
        'jabatan' => 'required|in:Dosen,Lektor,Guru Besar',
        'email' => 'required',
        'telepon' => 'required',
    ]);

    $dosen->update($request->all());

        return redirect()->route('mahasiswa.index')
                     ->with('success_dosen', 'Data Dosen berhasil diupdate')
                     ->with('active_tab', 'dosen'); // <- tetap buka tab Dosen
    }
    
    public function destroy(Dosen $dosen)
    {
    $dosen->delete();
    return redirect()->route('mahasiswa.index')
                    ->with('success_dosen', 'Data Dosen berhasil dihapus')
                    ->with('active_tab', 'dosen'); // <- tetap buka tab Dosen
    }

}
