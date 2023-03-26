<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryResep extends Model
{
    use HasFactory;

    protected $table = 'history_resep';
    protected $primaryKey = 'id_resep';
    protected $fillable = ['foto_resep', 'id_dokter', 'id_pasien', 'id_farmasi'];
    protected $guarded = ['id_resep'];
}
