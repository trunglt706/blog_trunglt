<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Danhmucbaiviet extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('danhmucbaiviets')->truncate();
        $ar = [
            ['id' => 1, 'slug' => 'tam-su-cua-toi', 'name' => 'Tâm sự của tôi', 'intro' => 'Các bài viết về tâm sự của tôi', 'status' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 2, 'slug' => 'am-thuc', 'name' => 'Ẩm thực cùng tôi', 'intro' => 'Các bài viết về ẩm thực của tôi', 'status' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 3, 'slug' => 'am-nhac', 'name' => 'Âm nhạc của tôi', 'intro' => 'Các bài viết về âm nhạc của tôi', 'status' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 4, 'slug' => 'du-lich', 'name' => 'Du lịch cùng tôi', 'intro' => 'Các bài viết về các chuyến du lịch của tôi', 'status' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 5, 'slug' => 'tinh-yeu', 'name' => 'Tình yêu của tôi', 'intro' => 'Các bài viết về tình yêu của tôi', 'status' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 6, 'slug' => 'hoc-tap', 'name' => 'Học vấn của tôi', 'intro' => 'Các bài viết về học vấn của tôi', 'status' => 1, 'created_at' => date('Y-m-d H:i:s')]
        ];
        \App\danhmucbaiviets::insert($ar);

    }
}
