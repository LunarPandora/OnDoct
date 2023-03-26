<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farmasi;

class FarmasiController extends Controller
{
    public function index(Request $r){
        if($r->filterByName == 'asc'){
            $farmasi = Farmasi::all()->sortBy('nama_farmasi')->values();
        }
        elseif($r->filterByName == 'desc'){
            $farmasi = Farmasi::all()->sortByDesc('nama_farmasi')->values();
        }
        else{
            $farmasi = Farmasi::all()->toArray();
        }

        return $farmasi;
    }

    public function lookForEmail(Request $r){
        $farmasi = Farmasi::select('id', 'nama_farmasi', 'no_telp_farmasi', 'alamat_farmasi')
                        ->where('email_farmasi', $r->get('email'))->first();
        return response()->json($farmasi);
    }

    public function store(Request $r){
        $farmasi = new Farmasi([
            'nama_farmasi' => $r->input('nama_farmasi'),
            'no_telp' => $r->input('no_telp'),
            'email_farmasi' => $r->input('email_farmasi'),
            'alamat_farmasi' => $r->input('alamat_farmasi'),
            'foto_izin' => $r->input('foto_izin')   
        ]);

        $farmasi->save();
        return response()->json('CREATED');
    }

    public function show($id)
    {
        $farmasi = Farmasi::find($id);
        return response()->json($farmasi);
    }

    public function update($id, Request $r)
    {
        $farmasi = Farmasi::find($id);
        $farmasi = $farmasi->update($r->all());
        return response()->json('UPDATED');
    }

    public function destroy($id)
    {
        $farmasi = Farmasi::find($id);
        $farmasi->delete();
        return response()->json('DELETED');
    }
}
