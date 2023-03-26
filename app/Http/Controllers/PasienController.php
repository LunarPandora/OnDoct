<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\BookingAppointment;

class PasienController extends Controller
{
    public function index(Request $r)
    {
        if($r->filterByDate == 'asc'){
            $pasien = BookingAppointment::join('pasien as p', 'p.id', '=', 'booking_appointment.id_pasien')->where('id_dokter', $r->id)->get()->sortBy('waktu_appointment')->values();
        }
        elseif($r->filterByDate == 'desc'){
            $pasien = BookingAppointment::join('pasien as p', 'p.id', '=', 'booking_appointment.id_pasien')->where('id_dokter', $r->id)->get()->sortByDesc('waktu_appointment')->values();
        }
        else{
            $pasien = BookingAppointment::join('pasien as p', 'p.id', '=', 'booking_appointment.id_pasien')->where('id_dokter', $r->id)->get()->toArray();
        }

        return $pasien;
    }

    public function store(Request $r){
        $pasien = new Pasien([
            'nama_pasien' => $r->input('nama'),
            'no_telp' => $r->input('no_telp'),
            'email_pasien' => $r->input('email_pasien'),
            'gender' => $r->input('gender'),
            'alergi' => $r->input('alergi'),
            'agama' => $r->input('agama')
        ]);

        $pasien->save();
        return response()->json('CREATED');
    }

    public function show($id)
    {
        $pasien = Pasien::find($id);
        return response()->json($pasien);
    }

    public function lookForEmail(Request $r){
        $pasien = Pasien::select('id', 'nama_pasien', 'no_telp_pasien', 'alamat_pasien')
                        ->where('email_pasien', $r->get('email'))->first();

        return response()->json($pasien);
    }

    public function update($id, Request $r)
    {
        $pasien = Pasien::find($id);
        $pasien = $pasien->update($r->all());
        return response()->json('UPDATED');
    }

    public function destroy($id)
    {
        $pasien = Pasien::find($id);
        $pasien->delete();
        return response()->json('DELETED');
    }
}
