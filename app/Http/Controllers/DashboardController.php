<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Code;
use App\Models\Kelas;
use App\Models\Materi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kelas = Kelas::all();
        $materi = Materi::all();

        $absen = Absensi::where('user_id', $user->id)->whereNotNull('start')->whereNull('end')->first();

        return view('dashboard.dashboard', compact(['kelas', 'materi', 'absen', 'user']));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'kelas_id' => 'required',
            'materi_id' => 'required',
            'teaching_role' => 'required',
            'code' => 'required'
        ]);

        $input_code = $request->code;
        $code = Code::where('code', $input_code)->first();

        if ($code && $code->user_id !== $user->id) {

            if ($input_code == $code->code && empty($code->id_user_get)) {
                $code->id_user_get = $user->id;
                $code->save();

                Absensi::create([
                    'kelas_id' => $request->kelas_id,
                    'materi_id' => $request->materi_id,
                    'teaching_role' => $request->teaching_role,
                    'code_id' => $code->id,
                    'user_id' => $user->id,
                    'start' => Carbon::now(),
                    'date' => Carbon::today()
                ]);
                return redirect('/')->with('success', 'Absensi berhasil');
            } else {
                return redirect('/')->with('error', 'Kode absen sudah digunakan');
            }
        } else {
            return redirect('/')->with('error', 'Kode Absen tidak valid, silahkan hubungi assisten lab');
        }
    }


    public function update(Request $request)
    {
        $absensi_id = $request->input('absensi_id');
        $attendance = Absensi::findOrFail($absensi_id);

        $attendance->update([
            'end' => now(),
            'duration' => now()->diffInMinutes($attendance->start),
        ]);

        return redirect('/')->with('success', 'Check-out successfull');
    }
}
