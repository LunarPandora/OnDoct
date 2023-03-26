<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index(Request $r)
    {
        if($r->filterByName == 'asc'){
            $dokter = Dokter::all()->sortBy('nama_dokter')->values();
        }
        else if($r->filterByName == 'desc'){
            $dokter = Dokter::all()->sortByDesc('nama_dokter')->values();
        }
        else{
            $dokter = Dokter::all()->toArray();
        }

        return $dokter;
    }

    public function store(Request $r){
        $dokter = new Dokter([
            'nama_dokter' => $r->input('nama'),
            'jenis_spesialis' => $r->input('jenis_spesialis'),
            'no_telp' => $r->input('no_telp'),
            'email_dokter' => $r->input('email_dokter'),
            'alamat_praktek' => $r->input('alamat_praktek'),
            'gender' => $r->input('gender'),
            'foto_surat_praktek' => $r->input('foto_surat_praktek')
        ]);

        $dokter->save();
        return response()->json('CREATED');
    }

    public function show($id){
        $dokter = Dokter::find($id);
        return response()->json($dokter);
    }

    public function lookForEmail(Request $r){
        $dokter = Dokter::select('id', 'nama_dokter', 'no_telp_dokter', 'alamat_dokter')
                        ->where('email_dokter', $r->get('email'))->first();
        return response()->json($dokter);
    }

    public function update($id, Request $r){
        $dokter = Dokter::find($id);
        $dokter = $dokter->update($r->all());

        return response()->json('UPDATED');
    }

    public function destroy($id){
        $dokter = Dokter::find($id);
        $dokter->delete();

        return response()->JSON('DELETED');
    }
}
