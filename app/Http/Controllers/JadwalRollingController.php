<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Biodata;
use App\Models\User;
use App\Models\TipeAbsensi;
use App\Models\JadwalRolling;
use App\Models\Absensi;
use Carbon\Carbon;

class JadwalRollingController extends Controller
{
    //
    public static function view(){
        $jadwal_rolling = JadwalRolling::orderBy('Tanggal', 'ASC')->orderBy('WaktuMulai', 'ASC')->get();
        return view('jadwal_rolling_view')->with([
            'jadwal_rolling' => $jadwal_rolling,
        ]);
    }

    public static function crud_view(){
        $biodatas = Biodata::all();
        $terapises = User::where('Role', 3)->get();
        $user = Auth::user();
        if($user->Role == 3){
            $terapises = User::where('NoIdentitas', $user->NoIdentitas)->get();
        }
        $tipe_absensies = TipeAbsensi::all();
        $jadwal_rolling = JadwalRolling::whereHas('absensi',function($q) {
            $q->whereColumn('created_at', '>=', 'updated_at');
        })->get();
        return view('jadwal_rolling')->with([
            'biodatas' => $biodatas,
            'terapises' => $terapises,
            'tipe_absensies' => $tipe_absensies,
            'jadwal_rolling' => $jadwal_rolling,
        ]);
    }

    public static function insert(Request $request){
        // dd($request->Hari[1]);
        // dd($request->all());
        
        $validator = Validator::make($request->all(), [
            'NoIdentitas' => 'required',
            'IdAnak' => 'required',
            'IdTipe' => 'required',
            'Tanggal' => 'required',
            'Hari' => 'required',
            'WaktuMulai.0' => 'required_if:Hari.0,Senin|date_format:H:i',
            'WaktuSelesai.0' => 'required_if:Hari.0,Senin|date_format:H:i|after:WaktuMulai.0',
            'WaktuMulai.1' => 'required_if:Hari.1,Selasa|date_format:H:i',
            'WaktuSelesai.1' => 'required_if:Hari.1,Selasa|date_format:H:i|after:WaktuMulai.1',
            'WaktuMulai.2' => 'required_if:Hari.2,Rabu|date_format:H:i',
            'WaktuSelesai.2' => 'required_if:Hari.2,Rabu|date_format:H:i|after:WaktuMulai.2',
            'WaktuMulai.3' => 'required_if:Hari.3,Kamis|date_format:H:i',
            'WaktuSelesai.3' => 'required_if:Hari.3,Kamis|date_format:H:i|after:WaktuMulai.3',
            'WaktuMulai.4' => 'required_if:Hari.4,Jumat|date_format:H:i',
            'WaktuSelesai.4' => 'required_if:Hari.4,Jumat|date_format:H:i|after:WaktuMulai.4',
            'WaktuMulai.5' => 'required_if:Hari.5,Sabtu|date_format:H:i',
            'WaktuSelesai.5' => 'required_if:Hari.5,Sabtu|date_format:H:i|after:WaktuMulai.5',
            // 'WaktuMulai.*' => 'nullable|required_if:Hari.*,Selasa',
            // 'WaktuSelesai.*' => 'nullable|required_if:Hari.*,Selasa|after:WaktuMulai.*',
        ], [
            'required' => ':attribute harus diisi',
            'NoIdentitas.required' => 'Terapis harus diisi',
            'IdAnak.required' => 'Anak harus diisi',
            'IdTipe.required' => 'Tipe absensi harus diisi',
            'WaktuMulai.*.required_if' => 'Waktu mulai harus diisi',
            'WaktuSelesai.*.required_if' => 'Waktu selesai harus diisi',
            'WaktuSelesai.*.after' => 'Waktu selesai harus setelah waktu mulai'
        ]);
        // dd($validator->errors());
        if ($validator->fails()) {
            return redirect('/jadwal_rolling')
                        ->withErrors($validator)
                        ->withInput();
        }
        $tanggal = explode(" - ", $request->Tanggal);
        $startDate = Carbon::createFromFormat('d/m/Y',$tanggal[0]); 
        $endDate = Carbon::createFromFormat('d/m/Y',$tanggal[1]);
        $dates = [];
        
        while ($startDate->lte($endDate)) {
            if ( isset($request->Hari[0]) && $startDate->isMonday()) {
                array_push($dates, [
                    'Tanggal' => $startDate->toDateString(),
                    'Hari' => $request->Hari[0],
                    'WaktuMulai' => $request->WaktuMulai[0],
                    'WaktuSelesai' => $request->WaktuSelesai[0],

                ]);
            } else if ( isset($request->Hari[1]) && $startDate->isTuesday()) {
                array_push($dates, [
                    'Tanggal' => $startDate->toDateString(),
                    'Hari' => $request->Hari[1],
                    'WaktuMulai' => $request->WaktuMulai[1],
                    'WaktuSelesai' => $request->WaktuSelesai[1],

                ]);
            } else if ( isset($request->Hari[2]) && $startDate->isWednesday()) {
                array_push($dates, [
                    'Tanggal' => $startDate->toDateString(),
                    'Hari' => $request->Hari[2],
                    'WaktuMulai' => $request->WaktuMulai[2],
                    'WaktuSelesai' => $request->WaktuSelesai[2],

                ]);
            } else if ( isset($request->Hari[3]) && $startDate->isThursday()) {
                array_push($dates, [
                    'Tanggal' => $startDate->toDateString(),
                    'Hari' => $request->Hari[3],
                    'WaktuMulai' => $request->WaktuMulai[3],
                    'WaktuSelesai' => $request->WaktuSelesai[3],

                ]);
            } else if ( isset($request->Hari[4]) && $startDate->isFriday()) {
                array_push($dates, [
                    'Tanggal' => $startDate->toDateString(),
                    'Hari' => $request->Hari[4],
                    'WaktuMulai' => $request->WaktuMulai[4],
                    'WaktuSelesai' => $request->WaktuSelesai[4],

                ]);
            } else if ( isset($request->Hari[5]) && $startDate->isSaturday()) {
                array_push($dates, [
                    'Tanggal' => $startDate->toDateString(),
                    'Hari' => $request->Hari[5],
                    'WaktuMulai' => $request->WaktuMulai[5],
                    'WaktuSelesai' => $request->WaktuSelesai[5],

                ]);
            }
            $startDate->addDay(); // Move to the next day
        }
        // dd($dates);

        // $tanggal = Carbon::createFromFormat('d/m/Y',$request->Tanggal);
        // $waktuMulai = Carbon::createFromFormat('g:i a',$request->WaktuMulai)->format('H:i');
        // $waktuSelesai = Carbon::createFromFormat('g:i a',$request->WaktuSelesai)->format('H:i');
        // Check JadwalRolling pernah diinput atau tidak
        foreach($dates as $date){
            $check = JadwalRolling::where('IdAnak', $request->IdAnak)
                ->where('NoIdentitas', $request->NoIdentitas)
                ->where('IdTipe', $request->IdTipe)
                ->where('Tanggal', $date['Tanggal'])
                ->where('WaktuMulai', $date['WaktuMulai'])
                ->where('WaktuSelesai', $date['WaktuSelesai'])
                ->first();
            if($check){
                return redirect('/jadwal_rolling')
                            ->withErrors(['message' => 'JadwalRolling sudah pernah diinput'])
                            ->withInput();
            }
        }
        
        // Insert data
        foreach($dates as $date){
            $jadwal = new JadwalRolling;

            $jadwal->IdAnak = $request->IdAnak;
            $jadwal->NoIdentitas = $request->NoIdentitas;
            $jadwal->IdTipe = $request->IdTipe;
            $jadwal->Tanggal = $date['Tanggal'];
            // $date = $tanggal->locale('id');
            // $date->settings(['formatFunction' => 'translatedFormat']);
            // $jadwal->Hari = $date->format('l');
            $jadwal->Hari = $date['Hari'];
            $jadwal->WaktuMulai = $date['WaktuMulai'];
            $jadwal->WaktuSelesai = $date['WaktuSelesai'];

            $jadwal->save();

            $absensi = new Absensi;
            $absensi->IdJadwal = $jadwal->IdJadwal;
            $absensi->Hadir = 0;
            $absensi->save();
        }

        return redirect('/jadwal_rolling');
    }

    public static function edit_view($IdJadwal){
        $biodatas = Biodata::all();
        $terapises = User::where('Role', 3)->get();
        $user = Auth::user();
        if($user->Role == 3){
            $terapises = User::where('NoIdentitas', $user->NoIdentitas)->get();
        }
        $tipe_absensies = TipeAbsensi::all();
        $jadwal_rolling = JadwalRolling::find($IdJadwal);
        return view('jadwal_rolling_edit')->with([
            'biodatas' => $biodatas,
            'terapises' => $terapises,
            'tipe_absensies' => $tipe_absensies,
            'jadwal_rolling' => $jadwal_rolling,
        ]);
    }

    public static function edit(Request $request){
        $validator = Validator::make($request->all(), [
            'NoIdentitas' => 'required',
            'IdAnak' => 'required',
            'IdTipe' => 'required',
            'Tanggal' => 'required',
            'WaktuMulai' => 'required',
            'WaktuSelesai' => 'required|after:WaktuMulai',
        ], [
            'required' => ':attribute harus diisi',
            'NoIdentitas.required' => 'Terapis harus diisi',
            'IdAnak.required' => 'Anak harus diisi',
            'IdTipe.required' => 'Tipe absensi harus diisi',
            'WaktuSelesai.after' => 'Waktu selesai harus setelah waktu mulai'
        ]);
        if ($validator->fails()) {
            return redirect('/jadwal_rolling_edit/'.$request->IdJadwal)
                        ->withErrors($validator)
                        ->withInput();
        }
        $tanggal = Carbon::createFromFormat('d-m-Y',$request->Tanggal);
        // $waktuMulai = Carbon::createFromFormat('g:i a',$request->WaktuMulai)->format('H:i');
        // $waktuSelesai = Carbon::createFromFormat('g:i a',$request->WaktuSelesai)->format('H:i');
        $check = JadwalRolling::where('IdAnak', $request->IdAnak)
                ->where('NoIdentitas', $request->NoIdentitas)
                ->where('IdTipe', $request->IdTipe)
                ->where('Tanggal', $tanggal->toDateString())
                ->where('WaktuMulai', $request->WaktuMulai)
                ->where('WaktuSelesai', $request->WaktuSelesai)
                ->first();
        if($check){
            return redirect('/jadwal_rolling_edit/'.$request->IdJadwal)
                        ->withErrors(['message' => 'JadwalRolling sudah pernah diinput'])
                        ->withInput();
        }
        $jadwal = JadwalRolling::find($request->IdJadwal);

        $jadwal->IdAnak = $request->IdAnak;
        $jadwal->NoIdentitas = $request->NoIdentitas;
        $jadwal->IdTipe = $request->IdTipe;
        $jadwal->Tanggal = $tanggal;
        $date = $tanggal->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $jadwal->Hari = $date->format('l');
        $jadwal->WaktuMulai = $request->WaktuMulai;
        $jadwal->WaktuSelesai = $request->WaktuSelesai;

        $jadwal->save();

        return redirect('/jadwal_rolling');
    }

    public static function delete($IdJadwal){
        $jadwal_rolling = JadwalRolling::where('IdJadwal', $IdJadwal)->first();
        $absensi = Absensi::where('IdJadwal', $IdJadwal)->first();
        $absensi->delete();
        $jadwal_rolling->delete();
        return redirect('/jadwal_rolling');
    }
}
