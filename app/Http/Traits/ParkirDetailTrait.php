<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


use App\Parkir as Park;
use App\ParkirDetail as Pd;

trait ParkirDetailTrait
{

    public function kalkulasiBayar($id)
    {
        $retrive = Park::find($id);
        $total_bayar = $this->kalkulasiParkir($id);


        $list_prepare = [
            'parkir_id'     => $retrive['id'],
            'biaya_total'   =>  $total_bayar
        ];

        $input_jabatan = Pd::create($list_prepare);
        if ($input_jabatan == true) {
            return response()->json([
                'status' => true,
                'respon_code' => Response::HTTP_CREATED,
                'message' => 'Data parkir berhasil terkalkulasi'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'respon_code' => Response::HTTP_NO_CONTENT,
                'message' => 'Data parkir gagal terkalkulasi.!'
            ]);
        }
    }


    public function kalkulasiParkir($get_param)
    {
        $get            = Park::find($get_param);
        $get_timein     = substr($get['time_in'], 11, 2);
        $get_timeout    = substr($get['time_out'], 11, 2);
        $get_durasi     = $get['durasi'];
        $total_bayar    = "";

        if ($get_timeout >= $get_timein) {

            if ($get_durasi > 2) {

                $total_bayar = 2000 + (($get_durasi - 2) * 500);
                return $total_bayar;
            } else {

                $total_bayar  = 2000;
                return $total_bayar;
            }
        }
    }

    public function getKalkulasi()
    {
        $query = Pd::all();
        return $query;
    }
}
