<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cauhinhchungs extends Model {

    protected $table = 'cauhinhchungs';

    /**
     * @function get config
     * @param string $key
     * @param string $value
     * @return object
     */
    public static function getHeThong($key, $value) {
        return cauhinhchungs::where($key, $value)->firstOrFail();
    }

}
