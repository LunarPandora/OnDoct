<?php

namespace App\Http\Controllers;

use App\Models\BookingAppointment;
use App\Models\Dokter;
use App\Models\HistoryAppointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function getHistoryPasien(Request $r){
        $history = HistoryAppointment::join('dokter as d', 'd.id', '=', 'history_appointment.id_dokter')
                            ->join('farmasi as f', 'f.id', '=', 'history_appointment.id_farmasi')
                            ->join('pasien as p', 'p.id', '=', 'history_appointment.id_pasien')
                            ->join('history_resep as hr', 'hr.id_resep', '=', 'history_appointment.id_history_resep')
                            ->select("history_appointment.id_appointment", "d.nama_dokter", "f.nama_farmasi", "p.nama_pasien", "history_appointment.riwayat", "history_appointment.waktu", "hr.foto_resep")
                            ->where('history_appointment.id_pasien', '=', $r->id);

        if($r->filterByName == '1' || $r->filterByName == 'dw'){
            $history = $history->orderBy('d.nama_dokter', 'desc');
        }
        if($r->filterByDate == '1' || $r->filterByDate == 'dw'){
            $history = $history->orderBy('history_appointment.waktu', 'asc');
        }

        return response()->json($history->get());
    }

    public function getQueueData(Request $r){
        $queue = BookingAppointment::where('id_dokter', '=', $r->idDokter)->max('antrian') + 1;

        return response()->json($queue);
    }

    public function bookQueue(Request $r){
        $r->validate([
            'antrian' => 'required',
            'idDokter' => 'required',
            'idPasien' => 'required',
            'waktu' => 'required'
        ]);

        BookingAppointment::create([
            'antrian' => $r->antrian,
            'id_dokter' => $r->idDokter,
            'id_pasien' => $r->idPasien,
            'waktu_appointment' => $r->waktu,
            'status_appointment' => 'menunggu'
        ]);

        return response()->json('success');
    }

    public function updateQueue(Request $r){
        BookingAppointment::where('id_appointment', $r->id)
                          ->update(['status_appointment' => $r->status]);

        return response()->json('success');
    }

    public function deleteQueue(Request $r){
        BookingAppointment::where('id_appointment', $r->id)
                          ->delete();

        return response()->json('success');
    }

    public function index(Request $r)
    {
        $appointment = BookingAppointment::join('dokter as d', 'd.id', '=', 'booking_appointment.id_dokter')
                                         ->join('pasien as p', 'p.id', '=', 'booking_appointment.id_pasien');

        if($r->target == 'pasien'){
            $appointment = $appointment->where('id_pasien', '=', $r->id)->get();
        }
        elseif($r->target == 'dokter'){
            if($r->status == 'berlangsung'){
                $appointment = $appointment->where([
                    ['booking_appointment.id_dokter', '=', $r->id],
                    ['status_appointment', '=', 'berlangsung']
                ])->get();
            }
            elseif($r->status == 'mengantri'){
                $appointment = $appointment->where([
                    ['booking_appointment.id_dokter', '=', $r->id],
                    ['status_appointment', '=', 'mengantri']
                ])->get();
            }
            elseif($r->status == 'menunggu'){
                $appointment = $appointment->where([
                    ['booking_appointment.id_dokter', '=', $r->id],
                    ['status_appointment', '=', 'menunggu']
                ])->get();
            }
        }

        if($r->filterByTgl == 'asc'){
            $appointment = $appointment->sortBy('waktu_appointment')->values();
        }
        else if($r->filterByTgl == 'desc'){
            $appointment = $appointment->sortByDesc('waktu_appointment')->values();
        }
        else{
            $appointment = $appointment->toArray();
        }

        return response()->json($appointment);
    }

    public function queueHistory(Request $r){
        $history = HistoryAppointment::join('farmasi as f', 'f.id', '=', 'history_appointment.id_farmasi')
                                     ->join('pasien as p', 'p.id', '=', 'history_appointment.id_pasien')
                                     ->join('history_resep as hr', 'hr.id_resep', '=', 'history_appointment.id_history_resep')
                                     ->where([
                                        ['history_appointment.status', '=', $r->status],
                                        ['history_appointment.id_dokter', '=', $r->id],
                                     ])
                                     ->select("history_appointment.id_appointment", "p.nama_pasien", "f.nama_farmasi", "hr.created_at", "history_appointment.waktu", "hr.foto_resep");

        if($r->filterByDate == 'asc'){
            $history = $history->orderBy('history_appointment.waktu', 'asc')->get();
        }
        elseif($r->filterByDate == 'desc'){
            $history = $history->orderBy('history_appointment.waktu', 'desc')->get();
        }
        else{
            $history = $history->get();
        }

        return response()->json($history);
    }
}
