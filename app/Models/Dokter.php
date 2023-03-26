<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_dokter', 'no_telp_dokter', 'email_dokter', 'gender', 'alamat_dokter', 'foto_surat_praktek', 'jenis_spesialis'];
    protected $guarded = ['id_dokter'];
}
