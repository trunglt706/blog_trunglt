<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuangCao extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quangcaos')->truncate();
        $ar = [
            ['id' => 1, 'slug' => 'advs-1', 'name' => 'Quảng cáo 1', 'intro' => 'Quảng cáo 1', 'photo' => 'upload/quangcaos/1.JPG', 'link' => '', 'order' => 1, 'status' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 2, 'slug' => 'advs-2', 'name' => 'Quảng cáo 2', 'intro' => 'Quảng cáo 2', 'photo' => 'upload/quangcaos/2.JPG', 'link' => '', 'order' => 2, 'status' => 1, 'created_at' => date('Y-m-d H:i:s')]
        ];
        \App\quangcaos::insert($ar);
    }
}
