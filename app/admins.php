<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class admins extends Authenticatable
{
    protected $table = 'admins';

    public static function updateStatus($id) {
        $admin = admins::find(auth()->user()->id);
        $admin->status = 0;
        $admin->save();
    }
}
