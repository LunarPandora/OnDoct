<?php

namespace App\Http\Controllers;

use App\Models\BookingAppointment;
use App\Models\HistoryAppointment;
use App\Models\HistoryResep;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResepController extends Controller
{
    public function requestResep(Request $r){
        $r->validate([
            'id_pasien' => 'required',
            'id_dokter' => 'required',
            'id_farmasi' => 'required',
            'id_appointment' => 'required',
            'riwayat' => 'required',
            'waktu' => 'required',
        ]);

        $fr = $r->file('foto_resep');
        $nama_rn = Str::random(12) . "." . $fr->extension();
        $nama_fr = $nama_rn;

        $r->foto_resep->move(public_path('storage/foto_resep'), $nama_rn);

        $resep = HistoryResep::insertGetId([
            'foto_resep' => $nama_fr,
            'id_dokter' => $r->id_dokter,
            'id_pasien' => $r->id_pasien,
            'id_farmasi' => $r->id_farmasi
        ]);

        HistoryAppointment::create([
            'id_dokter' => $r->id_dokter,
            'id_pasien' => $r->id_pasien,
            'id_farmasi' => $r->id_farmasi,
            'riwayat' => $r->riwayat,
            'waktu' => $r->waktu,
            'id_history_resep' => $resep,
            'status' => 'waiting'
        ]);

        BookingAppointment::where('id_appointment', $r->id_appointment)->delete();

        return redirect()->route('app');
    }

    public function getResep(Request $r){
        $resep = HistoryAppointment::join('dokter as d', 'd.id', '=', 'history_appointment.id_dokter')
                                   ->join('pasien as p', 'p.id', '=', 'history_appointment.id_pasien')
                                   ->join('history_resep as hr', 'hr.id_resep', '=', 'history_appointment.id_history_resep')
                                   ->where([
                                        ['history_appointment.status', '=', $r->status],
                                        ['history_appointment.id_farmasi', '=', $r->id],
                                    ])
                                    ->select("history_appointment.id_appointment", "p.nama_pasien", "d.nama_dokter", "hr.created_at", "history_appointment.waktu", "hr.foto_resep");
        
        if($r->filterByDate == 'asc'){
            $resep = $resep->orderBy('waktu', 'asc')->get();
        }
        elseif($r->filterByDate == 'desc'){
            $resep = $resep->orderBy('waktu', 'desc')->get();
        }
        else{
            $resep = $resep->get();
        }

        return response()->json($resep);
    }

    public function getQueue(Request $r){
        $queue = HistoryAppointment::where([
            ['status', '=', 'waiting'],
            ['id_farmasi', '=', $r->id],
        ])->count();

        return $queue;
    }

    public function updateQueue(Request $r){
        HistoryAppointment::where([
            ['status', '=', 'waiting'],
            ['id_appointment', '=', $r->id],
        ])->update(['status' => 'done']);

        return response()->json('success');
    }
}
