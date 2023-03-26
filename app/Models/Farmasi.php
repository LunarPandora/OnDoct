<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmasi extends Model
{
    use HasFactory;

    protected $table = 'farmasi';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_farmasi', 'no_telp_farmasi', 'email_farmasi', 'alamat_farmasi', 'foto_izin'];
    protected $guarded = ['id_farmasi'];
}
