<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardAdminController extends Controller
{
    //

    public function index(){
        return view('ProfilPolis.TambahPengguna');
    }

    public function store(Request $request){
        try {

            $unique = false;
            $no_polis = '';
            $no_lac = '';

            // Logika untuk menghasilkan nomor acak yang unik
            while (!$unique) {
                $no_polis = 'POL' . mt_rand(1000, 9999); // Ganti dengan format yang sesuai
                $no_lac = 'LAC' . mt_rand(1000, 9999); // Ganti dengan format yang sesuai

                // Pastikan nomor belum ada dalam basis data
                if (!User::where('no_polis', $no_polis)->where('no_lac', $no_lac)->exists()) {
                    $unique = true;
                }
            }
            $validasiData = $request->validate([
                'no_polis' => 'required|max:255',
                'no_lac' => 'required|max:255',
                'no_rek' => 'required|max:255',
                'nama_lengkap' => 'required|max:255',
                'nama_ibu' => 'required|max:255',
                'nik' => 'required|max:255',
                'tempat_lahir' => 'required|max:255',
                'tanggal_lahir' => 'required|max:255',
                'alamat' => 'required|max:255',
                'no_telp' => 'required|max:255',
                'no_telp2' => 'max:255',
                'foto_ktp' => 'image|file|max:10024', // Pastikan ada atribut 'foto_ktp' di dalam form
                'foto_kk' => 'image|file|max:10024', // Pastikan ada atribut 'foto_kk' di dalam form
                'foto_pribadi' => 'image|file|max:10024', // Pastikan ada atribut 'foto_pribadi' di dalam form
                'email' => 'required|email:dns|unique:users',
                'email2' => 'email:dns|unique:users',
            ]);

            if ($request->hasFile('foto_ktp')) {
                $validasiData['foto_ktp'] = $request->file('foto_ktp')->store('post-images');
            }

            if ($request->hasFile('foto_kk')) {
                $validasiData['foto_kk'] = $request->file('foto_kk')->store('post-images');
            }

            if ($request->hasFile('foto_pribadi')) {
                $validasiData['foto_pribadi'] = $request->file('foto_pribadi')->store('post-images');
            }

            $validasiData['no_polis'] = $no_polis;
            $validasiData['no_lac'] = $no_lac;


            User::create($validasiData);

            return redirect('/PilihPolis')
                    ->with('user_data', $validasiData);




            // return response()->json([
            //     'status' => 'success',
            //     'message' => 'Selamat, Anda telah berhasil mendaftar!',
            // ]);


        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
        // return redirect('/ProfilPolis1')->with('success', 'REGISTRASI BERHASIL');

    }




    //TAMBAH POLIS

    public function daftarPolis(){
        $userData = session('user_data');
        return view('ProfilPolis.PilihPolis',compact('userData'));
    }
}
