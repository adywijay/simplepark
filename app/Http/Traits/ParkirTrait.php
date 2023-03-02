<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Carbon\Carbon;


use App\Parkir as Park;

trait ParkirTrait
{

    public function addManualParkir($pram_insert)
    {

        $call_waktu   =  Carbon::now();
        $awal  = date_create(substr($pram_insert['time_in'], 11, 5));
        $akhir = date_create(substr($pram_insert['time_out'], 11, 5));
        $input_waktu  = date_diff($awal, $akhir);
        $sesi = "$input_waktu->h";
        $list_prepare = [
            'time_in' => $pram_insert['time_in'],
            'time_out' => $pram_insert['time_out'],
            'durasi' => $sesi
        ];

        $input_jabatan = Park::create($list_prepare);
        if ($input_jabatan == true) {
            return response()->json([
                'status' => true,
                'respon_code' => Response::HTTP_CREATED,
                'message' => 'Data parkir berhasil ditambahkan'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'respon_code' => Response::HTTP_NO_CONTENT,
                'message' => 'Data parkir gagal ditambahkan.!'
            ]);
        }
    }


    public function getDataParkir()
    {
        $query = Park::all();
        return $query;
    }
}
