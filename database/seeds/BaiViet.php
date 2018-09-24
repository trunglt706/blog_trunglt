<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaiViet extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('baiviets')->truncate();
        $ar = [
            ['id' => 1, 'id_danhmuc' => 1, 'username' => 'admin1', 'slug' => 'bai-viet-1', 'name' => 'There are many variations of passages of Lorem Ipsum available, but the majority have', 'intro' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'background' => '', 'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'thumn' => 'upload/baiviets/1.JPG', 'view' => 0, 'like' => 0, 'status' => 1, 'keyword' => 'news 1', 'important' => 0, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 2, 'id_danhmuc' => 1, 'username' => 'admin1', 'slug' => 'bai-viet-2', 'name' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece', 'intro' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'background' => '', 'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'thumn' => 'upload/baiviets/2.JPG', 'view' => 0, 'like' => 0, 'status' => 1, 'keyword' => 'news 2', 'important' => 0, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 3, 'id_danhmuc' => 2, 'username' => 'admin1', 'slug' => 'bai-viet-3', 'name' => 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested', 'intro' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'background' => '', 'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'thumn' => 'upload/baiviets/3.JPG', 'view' => 0, 'like' => 0, 'status' => 1, 'keyword' => 'news 3', 'important' => 0, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 4, 'id_danhmuc' => 2, 'username' => 'admin1', 'slug' => 'bai-viet-4', 'name' => 'It is a long established fact that a reader will be distracted by the readable', 'intro' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'background' => '', 'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'thumn' => 'upload/baiviets/4.JPG', 'view' => 0, 'like' => 0, 'status' => 1, 'keyword' => 'news 4', 'important' => 0, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 5, 'id_danhmuc' => 3, 'username' => 'admin1', 'slug' => 'bai-viet-5', 'name' => 'Replication For Dummies 4 Easy Steps To Professional DVD', 'intro' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'background' => '', 'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'thumn' => 'upload/baiviets/5.JPG', 'view' => 0, 'like' => 0, 'status' => 1, 'keyword' => 'news 5', 'important' => 0, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 6, 'id_danhmuc' => 4, 'username' => 'admin1', 'slug' => 'bai-viet-6', 'name' => 'Health & Fitness Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard', 'intro' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'background' => '', 'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'thumn' => 'upload/baiviets/6.JPG', 'view' => 0, 'like' => 0, 'status' => 1, 'keyword' => 'news 6', 'important' => 1, 'created_at' => date('Y-m-d H:i:s')],
        ];
        \App\baiviets::insert($ar);
    }
}
