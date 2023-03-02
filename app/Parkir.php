<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parkir extends Model
{
    protected $table = "parkirs";
    protected $fillable = [
        'time_in',
        'time_out',
        'durasi'
    ];

    public function ParkirDetail()
    {
        return $this->hasOne('App\ParkirDetail');
    }
}
