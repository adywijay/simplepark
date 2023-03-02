<?php

namespace App\Http\Controllers;

use App\Http\Traits\ParkirDetailTrait;
use App\Http\Traits\ParkirTrait;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Parkir as Park;
use App\ParkirDetail as Pd;
use Illuminate\Support\Facades\DB;

class General extends Controller
{

    use ParkirTrait;
    use ParkirDetailTrait;

    public function index()
    {
        return view('admin.home_view', [
            "judul" => "Dashboard"
        ]);
    }

    public function getParkir()
    {
        $call = $this->getDataParkir();
        return view('admin.mtdata_parkir_all', [
            "judul" => "Dashboard"
        ], compact('call'));
    }


    public function getTotalBayarParkir()
    {
        $call = $this->getKalkulasi();
        return view('admin.mtdata_kalkulasi_parkir', [
            "judul" => "Dashboard"
        ], compact('call'));
    }


    //---------------------------------------------------------------------------------------------------------
    public function addParkir(Request $req)
    {
        $this->validate($req, [
            'time_in'   => 'required',
            'time_out'  => 'required'
        ]);
        $pram_insert = [
            'time_in'   => $req->time_in,
            'time_out'  => $req->time_out
        ];
        return $this->addManualParkir($pram_insert);
    }


    public function parkirKalkulasi($id)
    {
        return $this->kalkulasiBayar($id);
    }

    // public function tes()
    // {
    //     $call_waktu   =  Carbon::now();
    //     $awal  = date_create('09.00');
    //     $akhir = date_create($call_waktu->toTimeString()); // waktu sekarang
    //     $input_waktu  = date_diff($awal, $akhir);
    //     $sesi = "$input_waktu->h jam $input_waktu->i menit $input_waktu->s detik";

    //     dd(substr("2023-02-28 14:20:55", 11, 2));
    // }

    // public function addParkir()
    // {
    //     $get = Park::find(1);
    //     $a = substr($get['time_in'], 11, 2);
    //     $b = substr($get['time_out'], 11, 2);
    //     $c = $get['durasi'];
    //     $d = "";

    //     if ($b >= $a) {

    //         if ($c > 2) {

    //             $d = 2000 + (($c - 2) * 500);
    //             echo $d;
    //         } else {

    //             $d = 2000;
    //             echo $d;
    //         }
    //     }
    // }
}
