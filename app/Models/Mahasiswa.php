<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;

    Protected $fillable = [
    'nama',
    'nim',
    'jenis_kelamin',
    'prodi',
    'tahun_angkatan',
    'tanggal_lahir',
     ];
}