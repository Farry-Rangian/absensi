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
        return view('index', compact(['kelas', 'materi', 'code', 'user']));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kelas_id' => 'required',
            'materi_id'=> 'required',
            'teaching_role' => 'required',
            'code' => 'required',
        ]);
        //jangan lupa buat validasi rentang waktunya lihat di chatgpt yg sudah dibbuat
        
        $user = Auth::user();
        $date = Carbon::now("GMT+7");
        $codes = Code::all();

        // Mencari kode yang sesuai dengan inputan dari permintaan
        $input = $request->input('code');
        $codeMatch = $codes->where('code', $input)->first();

        // Jika kode cocok dan belum digunakan, dapatkan id-nya
        if ($codeMatch && is_null($codeMatch->id_user_get)) {
                $codeMatch->id_user_get = $user->id;
                $code_id = $codeMatch->id;
                $kelas_id = $request->kelas_id;
                $materi_id = $request->materi_id;
                $teaching_role = $request->teaching_role;
                $user_id = $user->id;
                $tanggal = $date->toDateString();
                $start = $date->toTimeString();
                $codeMatch->save();
            } else {
                // Code tidak valid: sudah digunakan atau tidak ditemukan
                return back()->withErrors(['code' => 'Kode absen tidak valid.'])->withInput();
            }

        $absensi = new Absensi;
        $absensi->kelas_id = $kelas_id;
        $absensi->materi_id = $materi_id;
        $absensi->teaching_role = $teaching_role;
        $absensi->code_id = $code_id;
        $absensi->user_id = $user_id;
        $absensi->date = $tanggal;
        $absensi->start = $start;
        $absensi->save();
        // dd($absensi);
        return redirect()->back()->with('success', 'Anda berhasil melakukan absensi.');
        

    }
}
