<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->truncate();
        $admin = new \App\admins();
        $admin->username = 'admin1';
        $admin->name = 'admin1';
        $admin->email = 'lamthanhtrung706@gmail.com';
        $admin->password = bcrypt('trunglt');
        $admin->save();
    }
}
