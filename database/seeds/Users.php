<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $users = new \App\users();
        $users->id_loaithanhvien = 1;
        $users->username = 'user1';
        $users->name = 'user1';
        $users->email = 'lamthanhtrung706@gmail.com';
        $users->password = bcrypt('trunglt');
        $users->save();
    }
}
