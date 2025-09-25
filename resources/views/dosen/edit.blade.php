<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dosen</title>
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Form Edit Data Dosen</h2>
        <hr>

        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Terjadi kesalahan input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('dosen.update', $dosen) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $dosen->nama) }}" required>
            </div>
            <div class="mb-3">
                <label for="nidn" class="form-label">NIDN</label>
              <input type="text" class="form-control" id="nidn" name="nidn" value="{{ old('nidn', $dosen->nidn) }}" required>
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <select class="form-select" id="jabatan"
                name="jabatan" required>
                    <option value="">Pilih Jabatan</option>
                        <option value="Dosen" {{ old('jabatan', $dosen->jabatan ?? '') == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                        <option value="Lektor" {{ old('jabatan', $dosen->jabatan ?? '') == 'Lektor' ? 'selected' : '' }}>Lektor</option>
                        <option value="Guru Besar" {{ old('jabatan', $dosen->jabatan ?? '') == 'Guru Besar' ? 'selected' : '' }}>Guru Besar</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
              <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $dosen->email) }}" required>
            </div>
            <div class="mb-3">
                <label for="telepon" class="form-label">No Hp</label>
              <input type="text" class="form-control" id="telepon" name="telepon" value="{{ old('telepon', $dosen->telepon) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('dosen.index') }}" class="btn btn-secondary">
            Kembali</a>
        </form>
    </div>
</body>
</html>
