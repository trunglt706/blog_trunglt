<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cauhinhchungs extends Model
{

    protected $table = 'cauhinhchungs';

    public static function getHeThong($key, $value) {
        return cauhinhchungs::where($key, $value)->firstOrFail();
    }
}
