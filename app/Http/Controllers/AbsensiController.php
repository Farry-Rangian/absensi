<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Code;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absensis = Absensi::all();
        // $kelas = Kelas::all();
        // $materi = Materi::all();
        // $code = Code::all();
        // $user = Auth::user();
        // return view('absensi.index', compact(['kelas','kelas', 'materi', 'code', 'user']));
        return view('absensi.index', compact('absensis'));
    }

    public function riwayat()
    {
        $user = Auth::user();
        $absensis = Absensi::where('user_id', $user->id)->get();
        return view('absensi.riwayat', compact('absensis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'kelas_id' => 'required',
        //     'materi_id'=> 'required',
        //     'teaching_role' => 'required',
        //     'code' => 'required',
        // ]);
        // //jangan lupa buat validasi rentang waktunya lihat di chatgpt yg sudah dibbuat
        
        // $user = Auth::user();
        // $date = Carbon::now("GMT+7");
        // $codes = Code::all();

        // // Mencari kode yang sesuai dengan inputan dari permintaan
        // $input = $request->input('code');
        // $codeMatch = $codes->where('code', $input)->first();

        // // Jika kode cocok dan belum digunakan, dapatkan id-nya
        // if ($input == $codeMatch->code && (empty($codeMatch->id_user_get))) {
        //     if($codeMatch->user_id != $user->user_id) {
        //         $codeMatch->id_user_get = $user->id;
        //         $code_id = $codeMatch->id;
        //         $kelas_id = $request->kelas_id;
        //         $materi_id = $request->materi_id;
        //         $teaching_role = $request->teaching_role;
        //         $user_id = $user->id;
        //         $tanggal = $date->toDateString();
        //         $start = $date->toTimeString();
        //         $codeMatch->save();

        //         $absensi = new Absensi;
        //         $absensi->kelas_id = $kelas_id;
        //         $absensi->materi_id = $materi_id;
        //         $absensi->teaching_role = $teaching_role;
        //         $absensi->code_id = $code_id;
        //         $absensi->user_id = $user_id;
        //         $absensi->date = $tanggal;
        //         $absensi->start = $start;
        //         $absensi->save();
        //         return redirect()->back()->with('success', 'Anda berhasil melakukan absensi.');
        //     }
        //     } else {
        //         // Code tidak valid: sudah digunakan atau tidak ditemukan
        //         return back()->withErrors(['code' => 'Kode absen tidak valid.'])->withInput();
        //     }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}
