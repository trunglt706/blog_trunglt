<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Users::class);
        $this->call(Admin::class);
        $this->call(Cauhinhchung::class);
        $this->call(Danhmucbaiviet::class);
        $this->call(Loaithanhvien::class);
        $this->call(BaiViet::class);
        $this->call(QuangCao::class);
        $this->call(HoiDap::class);
    }
}
