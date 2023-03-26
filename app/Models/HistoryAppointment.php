<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryAppointment extends Model
{
    use HasFactory;

    protected $table = 'history_appointment';
    protected $primaryKey = 'id_appointment';
    protected $fillable = ['id_dokter', 'id_farmasi', 'id_pasien', 'id_history_resep', 'riwayat', 'waktu', 'status'];
    protected $guarded = ['id_appointment'];
}
