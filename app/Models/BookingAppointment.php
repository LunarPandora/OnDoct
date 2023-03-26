<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingAppointment extends Model
{
    use HasFactory;

    protected $table = 'booking_appointment';
    protected $primaryKey = 'id_appointment';
    protected $fillable = ['antrian', 'id_dokter', 'id_pasien', 'waktu_appointment', 'status_appointment'];
    protected $guarded = ['id_appointment'];
}
