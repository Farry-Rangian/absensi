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
        
        $user = Auth::user();
        $date = Carbon::now("GMT+7");
        $codes = Code::all();

        $input = $request->input('code');
        $codeMatch = $codes->where('code', $input)->first();
        // dd($codeMatch->code, $input);

        if ($codeMatch && $codeMatch->code == $input && is_null($codeMatch->id_user_get)) {
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
        } else {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.'], 400);
        }
    }
}
