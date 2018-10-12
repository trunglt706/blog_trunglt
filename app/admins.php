<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class admins extends Authenticatable {

    protected $table = 'admins';

    /**
     * @function update status of admin
     * @param integer $id
     */
    public static function updateStatus($id) {
        $admin = admins::find($id);
        $admin->status = 0;
        $admin->save();
    }

}
