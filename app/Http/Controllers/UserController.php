<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Farmasi;

class UserController extends Controller
{
    public function store(Request $r){
        $r->validate([
            'password' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'jenis_akun' => 'required',
            'no_telp' => 'required|max:15',
            'alamat' => 'required'
        ]);

        User::create([
            'email' => $r->email, 
            'password' => Hash::make($r->password), 
            'status' => $r->jenis_akun
        ]);

        if($r->jenis_akun == 'pasien'){
            $r->validate([
                'alergi' => 'required',
                'agama' => 'required'
            ]);

            Pasien::create([
                'nama_pasien' => $r->nama,
                'no_telp_pasien' => $r->no_telp,
                'email_pasien' => $r->email,
                'gender' => $r->gender,
                'alergi' => $r->alergi,
                'agama' => $r->agama,
                'alamat_pasien' => $r->alamat,
            ]);
        }
        elseif($r->jenis_akun == 'dokter'){
            $r->validate([
                'jenis_spesialis' => 'required',
                'foto_surat_praktek' => 'required'
            ]);

            $fsp = $r->file('foto_surat_praktek');
            $nama_rn = Str::random(12) . "." . $fsp->extension();
            $nama_fsp = $nama_rn;

            Dokter::create([
                'nama_dokter' => $r->nama,
                'no_telp_dokter' => $r->no_telp,
                'email_dokter' => $r->email,
                'gender' => $r->gender,
                'jenis_spesialis' => $r->jenis_spesialis,
                'foto_surat_praktek' => $nama_fsp,
                'alamat_dokter' => $r->alamat,
            ]);

            $r->foto_surat_praktek->move(public_path('storage/foto_surat_praktek'), $nama_rn);
        }
        elseif($r->jenis_akun == 'farmasi'){
            $r->validate([
                'foto_izin' => 'required'
            ]);

            $fi = $r->file('foto_izin');
            $nama_rn = Str::random(12) . "." . $fi->extension();
            $nama_fi = $nama_rn;

            Farmasi::create([
                'nama_farmasi' => $r->nama,
                'no_telp_farmasi' => $r->no_telp,
                'email_farmasi' => $r->email,
                'foto_izin' => $nama_fi,
                'alamat_farmasi' => $r->alamat,
            ]);

            $r->foto_izin->move(public_path('storage/foto_izin'), $nama_rn);
        }

        return redirect()->route('login');
    }

    public function authenticate(Request $r){
        $r->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $c = ['email' => $r->email, 'password' => $r->password];

        if(Auth::attempt($c)){
            $r->session()->regenerate();

            session(['email' => $r->email]);

            return redirect()->route('app');
        }
        else{
            return back()->withErrors([
                'text' => 'Email atau Password anda salah!'
            ]);
        };
    }

    public function main(){
        return view('app');
    }

    // protected function logout(Request $r){
    //     Auth::logout();
    //     $r->session()->invalidate();
    //     $r->session()->regenerateToken();

    //     return redirect()->route('app');
    // }

    public function retrieve(Request $r){
        return response()->json(User::select('status', 'email')
        ->where([
            ['email', $r->session()->get('email')],
        ])
        ->first());
    }
}
