<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Code;
use App\Models\Kelas;
use App\Models\Materi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kelas = Kelas::all();
        $materi = Materi::all();
        $code = Code::all();
        $user = Auth::user();
        // $absensi = Absensi::where('user_id', $user->id)
        //               ->whereNull('end')
        //               ->first();
        return view('index', compact(['kelas', 'materi', 'code', 'user']));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kelas_id' => 'required',
            'materi_id' => 'required',
            'teaching_role' => 'required',
            'code' => 'required',
        ]);

        $user = Auth::user();
        $date = Carbon::now("GMT+7");
        $codes = Code::all();

        $input = $request->input('code');
        $codeMatch = $codes->where('code', $input)->first();

        if ($codeMatch && $input == $codeMatch->code && empty($codeMatch->id_user_get)) {
            if ($codeMatch->user_id != $user->user_id) {
                $codeMatch->id_user_get = $user->id;
                $code_id = $codeMatch->id;
                $kelas_id = $request->kelas_id;
                $materi_id = $request->materi_id;
                $teaching_role = $request->teaching_role;
                $user_id = $user->id;
                $tanggal = $date->toDateString();
                $start = $date->toTimeString();
                $codeMatch->save();

                $absensi = new Absensi;
                $absensi->kelas_id = $kelas_id;
                $absensi->materi_id = $materi_id;
                $absensi->teaching_role = $teaching_role;
                $absensi->code_id = $code_id;
                $absensi->user_id = $user_id;
                $absensi->date = $tanggal;
                $absensi->start = $start;
                $absensi->save();
                return response()->json(['message' => 'Data berhasil disimpan.']);
                return redirect()->route('home.show', ['id' => $user->id]);
            }
        } else {
            // Code tidak valid: sudah digunakan, tidak ditemukan, atau tidak ada
            return response()->json(['message' => 'Code invalid']);
        }
    }

    public function update(Request $request, Absensi $absensi)
    {

        $user = Auth::user();
        $date = Carbon::now("GMT+7");

        // Cari data absensi yang belum berakhir untuk pengguna saat ini
        $absensi = Absensi::where('user_id', $user->id)
                          ->whereNull('end')
                          ->first();

        if ($absensi) {
            // Update kolom 'end' dengan waktu sekarang
            $absensi->end = $date->toTimeString();

            // Hitung durasi absensi dan simpan ke kolom 'duration'
            if ($absensi->start) {
                $start = Carbon::parse($absensi->start)->setTimezone('GMT+7'); // Set timezone explicitly
                $end = $date->setTimezone('GMT+7'); // Set timezone explicitly
                
                // Konversi waktu mulai dan waktu selesai menjadi detik
                $start_seconds = strtotime($start);
                $end_seconds = strtotime($end);

                // Hitung perbedaan waktu dalam detik
                $time_difference = $end_seconds - $start_seconds;

                $duration_in_minutes = round($time_difference / 60);

                // Tampilkan hasil
                echo "Durasi dalam menit: " . $duration_in_minutes;
                // dd([$start, $end, $duration]);
            }

            // Simpan perubahan
            $absensi->save();

            return response()->json(['message' => 'Clock Out berhasil.']);
        } else {
            return response()->json(['message' => 'Tidak ada sesi absensi yang berlangsung.']);
        }

    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        // Ambil data absensi pengguna dengan ID yang sesuai
        $absensi = Absensi::where('user_id', $id)
                          ->whereNull('end')
                          ->first();

        // Jika data absensi ditemukan, tampilkan halaman untuk "Clock Out"
        if ($absensi) {
            return view('absensi.show', ['absensi' => $absensi]);
        } else {
            // Jika tidak ada sesi absensi yang berlangsung, mungkin tampilkan pesan atau alihkan ke halaman lain
            return redirect()->route('home.index')->with('error', 'Tidak ada sesi absensi yang berlangsung.');
        }
    }

}
