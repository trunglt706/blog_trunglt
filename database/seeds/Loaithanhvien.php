<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Loaithanhvien extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('loaithanhviens')->truncate();
        $ar = [
            ['id' => 1, 'slug' => 'member-vang', 'name' => 'Thành viên vàng', 'intro' => 'Thành viên vàng', 'status' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 2, 'slug' => 'member-bac', 'name' => 'Thành viên bạc', 'intro' => 'Thành viên bạc', 'status' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 3, 'slug' => 'member-dong', 'name' => 'Thành viên đồng', 'intro' => 'Thành viên đồng', 'status' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 4, 'slug' => 'member-chuan', 'name' => 'Thành viên chuẩn', 'intro' => 'Thành viên chuẩn', 'status' => 1, 'created_at' => date('Y-m-d H:i:s')]
        ];
        \App\loaithanhviens::insert($ar);
    }
}
