<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_pasien', 'no_telp_pasien', 'email_pasien', 'gender', 'alergi', 'agama', 'alamat_pasien'];
    protected $guarded = ['id_pasien'];
}
