<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PolisAktif;
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
                // 'email' => 'required|email:dns|unique:users',
                'email2' => 'email:dns|unique:users',
            ]);

            if ($request->hasFile('foto_ktp')) {
                $validasiData['foto_ktp'] = $request->file('foto_ktp')->store('ktp_images');
            }

            if ($request->hasFile('foto_kk')) {
                $validasiData['foto_kk'] = $request->file('foto_kk')->store('kk-images');
            }

            if ($request->hasFile('foto_pribadi')) {
                $validasiData['foto_pribadi'] = $request->file('foto_pribadi')->store('pribadi-images');
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

    public function tambahdaftarPolis(Request $request){
        try {
            // $user_id = session('user_id'); // Ambil user_id dari sesi

            // dd($user_id);

            // $nomorPolis = $user_id;

            $user = User::where('no_polis', $request->input('user_id'))->first();

            if (!$user) {
                // Handle jika nomor polis tidak ditemukan
                return response()->json([
                    'status' => 'error',
                    'message' => 'Nomor polis tidak ditemukan',
                ]);
            }

        $validasiData = $request->validate([
            'nama_penerima' => ['required', 'min:3', 'max:255'],
            'alamat' => 'required',
            // 'user_id' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'nik' => 'required',
            'no_ktp' => 'required',
            'no_telp' => 'required',
            'foto_ktp' => 'required',
            'umur' => 'required',
            'foto_kk' => 'required',
            'email' => 'required|email:dns',
            'foto_pribadi' => 'required',
            'jenis_asuransi' => 'required',
            'periode_pembayaran' => 'required',
            'jumlah_tanggungan' => 'required|min:5|max:255'
        ]);

        // $validasiData['user_id'] = User::where('no_polis', $request['user_id']);
         // Menyimpan user_id dari hasil kueri
         $validasiData['user_id'] = $user->id;


        if ($request->hasFile('foto_ktp')) {
            $validasiData['foto_ktp'] = $request->file('foto_ktp')->store('penerima-image-ktp');
        }

        if ($request->hasFile('foto_kk')) {
            $validasiData['foto_kk'] = $request->file('foto_kk')->store('penerima-image-kk');
        }

        if ($request->hasFile('foto_pribadi')) {
            $validasiData['foto_pribadi'] = $request->file('foto_pribadi')->store('penerima-image-pribadi');
        }


            PolisAktif::create($validasiData);

            return response()->json([
                'status' => 'Sukses',
                'message' => 'Berhasil',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }


            // return redirect('/TambahPengguna')->with('success', 'Data pengguna berhasil diperbarui.');


    }

    public function show($id)
    {
        try {

            $user = User::findOrFail($id);

            // Mengambil ID dari URL
            $urlId = $id;


            // dd($urlId);
            return view('RingkasanPolisAdmin.create', compact('user', 'urlId'));

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
    }

    public function TambahPengguna(Request $request, $id)
{
    try {
        // Validasi data formulir jika diperlukan
        $validasiData = $request->validate([
            'nama_penerima' => ['required', 'min:3', 'max:255'],
            'alamat' => 'required',
            'user_id' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'nik' => 'required',
            'no_ktp' => 'required',
            'no_telp' => 'required',
            'foto_ktp' => 'required',
            'umur' => 'required',
            'foto_kk' => 'required',
            'email' => 'required|email:dns',
            'foto_pribadi' => 'required',
            'jenis_asuransi' => 'required',
            'periode_pembayaran' => 'required',
            'jumlah_tanggungan' => 'required|min:5|max:255'
        ]);

        // // Ambil data pengguna berdasarkan ID yang diklik pada tabel
        // $user = User::findOrFail($id);

        // // Simpan data formulir atau lakukan operasi lainnya sesuai kebutuhan
        // // // ...
        // $validasiData['user_id'] = $user;


        if ($request->hasFile('foto_ktp')) {
            $validasiData['foto_ktp'] = $request->file('foto_ktp')->store('penerima-image-ktp');
        }

        if ($request->hasFile('foto_kk')) {
            $validasiData['foto_kk'] = $request->file('foto_kk')->store('penerima-image-kk');
        }

        if ($request->hasFile('foto_pribadi')) {
            $validasiData['foto_pribadi'] = $request->file('foto_pribadi')->store('penerima-image-pribadi');
        }

        $polisAktif = new PolisAktif($validasiData);
        $polisAktif->save();
            return response()->json([
                'status' => 'Sukses',
                'message' => 'Berhasil',
            ]);
        // return redirect()->route('ringkasan_index')->with('success', 'Data berhasil disimpan.');
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'GAGAL',
            'message' => $e->getMessage(),
        ]);
    }
}


public function bayar($id){
    try {
        $user = PolisAktif::findOrFail($id);

        // Mengambil ID dari URL
        $urlId = $id;

        $user_id = $user->user_id;

        // Get user data
        $userData = User::where('id', $user_id)->first();

        // Use the created_at timestamp as the starting point
        $newDate = $user->created_at;

        if ($userData->periode_pembayaran == 'bulan') {
            $newDate = $newDate->addMonth();
        } elseif ($userData->periode_pembayaran == 'tahun') {
            $newDate = $newDate->addYear();
        } elseif ($userData->periode_pembayaran == '18 bulan') {
            $newDate = $newDate->addMonths(18); // 1.5 years is equivalent to 18 months
        }

        return view('RingkasanPolisUser.bayar', [
            'user' => $user,
            'data_user' => $userData,
            'newDate' => $newDate,
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ]);
    }
    // return view('RingkasanPolisUser.bayar');
}


public function asu(){

    return view('RingkasanPolisUser.asu');
}
}
