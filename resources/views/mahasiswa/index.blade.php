<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <style>
        /* 🔹 Ubah warna nav tab jadi abu gelap */
        .nav-tabs .nav-link {
            background-color: #495057;  /* abu-abu gelap */
            color: white;
            border: 1px solid #dee2e6;
            margin-right: 2px;
        }
        .nav-tabs .nav-link.active {
            background-color: #93a9c0ff;  /* abu-abu lebih gelap untuk tab aktif */
            color: #fff;
        }
    </style>
<script>
// jQuery solution
$(document).ready(function() {
    // Auto-hide alert setelah 3 detik
    $('.alert').delay(3000).fadeOut('slow', function() {
        $(this).alert('close');
    });
    
    // Atau cara lebih sederhana
    setTimeout(function() {
        $('.alert').fadeOut('slow', function() {
            $(this).remove();
        });
    }, 3000);
});
</script>
</head>

<body>
<body style="background-color: #e0e0e0;">


<div class="container mt-5">
    <h2>Manajemen Data Akademik</h2>
    <hr>

    {{-- Navigasi Tab --}}
    <ul class="nav nav-tabs" id="dataTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ session('active_tab', 'mahasiswa') == 'mahasiswa' ? 'active' : '' }}"
                    id="mahasiswa-tab" data-bs-toggle="tab" data-bs-target="#mahasiswa" type="button" role="tab">
                Mahasiswa
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ session('active_tab') == 'dosen' ? 'active' : '' }}"
                    id="dosen-tab" data-bs-toggle="tab" data-bs-target="#dosen" type="button" role="tab">
                Dosen
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ session('active_tab') == 'matakuliah' ? 'active' : '' }}"
                    id="matakuliah-tab" data-bs-toggle="tab" data-bs-target="#matakuliah" type="button" role="tab">
                Mata Kuliah
            </button>
        </li>
    </ul>

    <div class="tab-content mt-3">
        {{-- Tabel Mahasiswa --}}
        <div class="tab-pane fade {{ session('active_tab', 'mahasiswa') == 'mahasiswa' ? 'show active' : '' }}"
             id="mahasiswa" role="tabpanel">
            <h3>Daftar Data Mahasiswa</h3>
            <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary mb-3">Tambah Mahasiswa</a>

            @if (session('success_mahasiswa'))
                <div class="alert alert-success">{{ session('success_mahasiswa') }}</div>
            @endif

            <table class="table table-bordered">
                <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Jenis Kelamin</th>
                    <th>Prodi</th>
                    <th>Angkatan</th>
                    <th>Tgl Lahir</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($mahasiswas as $mahasiswa)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mahasiswa->nama }}</td>
                        <td>{{ $mahasiswa->nim }}</td>
                        <td>{{ $mahasiswa->jenis_kelamin }}</td>
                        <td>{{ $mahasiswa->prodi }}</td>
                        <td>{{ $mahasiswa->tahun_angkatan }}</td>
                        <td>{{ $mahasiswa->tanggal_lahir }}</td>
                        <td>
                            <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}">Edit</a> |
                            <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline"
                                        onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada data.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- Tabel Dosen --}}
        <div class="tab-pane fade {{ session('active_tab') == 'dosen' ? 'show active' : '' }}"
             id="dosen" role="tabpanel">
            <h3>Daftar Data Dosen</h3>
            <a href="{{ route('dosen.create') }}" class="btn btn-primary mb-3">Tambah Dosen</a>

            @if (session('success_dosen'))
                <div class="alert alert-success">{{ session('success_dosen') }}</div>
            @endif

            <table class="table table-bordered">
                <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIDN</th>
                    <th>Jabatan</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($dosens as $dosen)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dosen->nama }}</td>
                        <td>{{ $dosen->nidn }}</td>
                        <td>{{ $dosen->jabatan }}</td>
                        <td>{{ $dosen->email }}</td>
                        <td>{{ $dosen->telepon }}</td>
                        <td>
                            <a href="{{ route('dosen.edit', $dosen->id) }}">Edit</a> |
                            <form action="{{ route('dosen.destroy', $dosen->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline"
                                        onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- Tabel Mata Kuliah --}}
        <div class="tab-pane fade {{ session('active_tab') == 'matakuliah' ? 'show active' : '' }}"
             id="matakuliah" role="tabpanel">
            <h3>Daftar Data Mata Kuliah</h3>
            <a href="{{ route('matakuliah.create') }}" class="btn btn-primary mb-3">Tambah Matakuliah</a>

            @if (session('success_matakuliah'))
                <div class="alert alert-success">{{ session('success_matakuliah') }}</div>
            @endif

            <table class="table table-bordered">
                <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama MK</th>
                    <th>Kode MK</th>
                    <th>SKS</th>
                    <th>Semester</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($matakuliahs as $mk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mk->nama_mk }}</td>
                        <td>{{ $mk->kode_mk }}</td>
                        <td>{{ $mk->sks }}</td>
                        <td>{{ $mk->semester }}</td>
                        <td>
                            <a href="{{ route('matakuliah.edit', $mk->id) }}">Edit</a> |
                            <form action="{{ route('matakuliah.destroy', $mk->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline"
                                        onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
