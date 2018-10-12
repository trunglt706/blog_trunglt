<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class baiviets extends Model {

    protected $table = 'baiviets';

    /**
     * @function count baiviet of user
     * @param string $username
     * @return object
     */
    public static function countBaiVietUser($username) {
        return baiviets::where('username', $username)->where('status', 1)->count();
    }

}
