<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    //menampilkan data mahasiswa
    public function index()
    {
        $mahasiswas = Mahasiswa::orderBy('created_at', 'DESC')->get();
        $dosens = Dosen::orderBy('created_at', 'DESC')->get();
        $matakuliahs = Matakuliah::orderBy('created_at', 'DESC')->get();

        return view('mahasiswa.index', compact('mahasiswas','dosens','matakuliahs'));
    }

    //menampilkan form untuk membuat mahasiswa baru
    public function create()
    {
        return view('mahasiswa.create');
    }

    //menyimpan data mahasiswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:mahasiswas,nim|max:10',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'prodi' => 'required|string|max:255',
            'tahun_angkatan' => 'required|digits:4',
            'tanggal_lahir' => 'required|date',
        ]);

        //simpan data ke database
        Mahasiswa::create($request->all());

        //redirect ke halaman index dengan pesan sukses
        return redirect()->route('mahasiswa.index')
        ->with('success_mahasiswa', 'Data Mahasiswa berhasil ditambahkan!')
        ->with('active_tab', 'mahasiswa'); // <- tetap buka tab mahasiswa
    }
    
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
    $request->validate([
        'nama' => 'required',
        'nim' => 'required',
        'jenis_kelamin' => 'required',
        'prodi' => 'required',
        'tahun_angkatan' => 'required',
        'tanggal_lahir' => 'required|date',
    ]);

    $mahasiswa->update($request->all());

        return redirect()->route('mahasiswa.index')
                     ->with('success_mahasiswa', 'Data mahasiswa berhasil diupdate')
                     ->with('active_tab', 'mahasiswa'); // <- tetap buka tab mahasiswa
    }
    
    public function destroy(Mahasiswa $mahasiswa)
    {
    $mahasiswa->delete();
    return redirect()->route('mahasiswa.index')
    ->with('success_mahasiswa', 'Data Mahasiswa berhasil dihapus')
    ->with('active_tab', 'mahasiswa'); // <- tetap buka tab mahasiswa
    }

}
