<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Cauhinhchung extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cauhinhchungs')->truncate();
        $ar = [
            ['id' => 1, 'slug' => 'ten-website', 'name' => 'Tên website', 'intro' => 'Tên hiển thị của website', 'value' => 'TrungLT706 - My Blog', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 2, 'slug' => 'tagline-website', 'name' => 'Tagline website', 'intro' => 'Tagline hiển thị của website', 'value' => 'Tâm sự đời tôi', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 3, 'slug' => 'logo-website', 'name' => 'Logo website', 'intro' => 'Logo hiển thị của website', 'value' => 'image/system/my-logo.png', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 4, 'slug' => 'keyword-website', 'name' => 'SEO keyword', 'intro' => 'SEO keyword', 'value' => 'TrungLT, TrungLT706, Vlog, My Blog, đời tôi', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 5, 'slug' => 'intro-website', 'name' => 'SEO intro', 'intro' => 'SEO intro', 'value' => 'Website giới thiệu về cuộc đời tôi', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 6, 'slug' => 'link-facebook', 'name' => 'Link Facebook', 'intro' => 'Link Facebook', 'value' => 'https://fb.com/trunglt706', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 7, 'slug' => 'email-website', 'name' => 'Email website', 'intro' => 'Email hiển thị của website', 'value' => 'lamthanhtrung706@gmail.com', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 8, 'slug' => 'link-youtube', 'name' => 'Link Youtube', 'intro' => 'Link Youtube', 'value' => '', 'created_at' => date('Y-m-d H:i:s')],
        ];
        \App\cauhinhchungs::insert($ar);
    }
}
