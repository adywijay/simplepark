<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParkirDetail extends Model
{
    protected $table = "parkir_details";
    protected $fillable = [
        'parkir_id',
        'biaya_total'
    ];

    public function Parkir()
    {
        return $this->belongsTo('App\Parkir');
    }
}
