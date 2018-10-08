<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create sitemap';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $sitemap = \App::make('sitemap');
        // add home pages mặc định
        $sitemap->add(route('home'), \Carbon\Carbon::now(), '1.0', 'daily');
        $sitemap->add(route('contact'), \Carbon\Carbon::now(), '1.0', 'daily');
        $sitemap->add(route('hoidap'), \Carbon\Carbon::now(), '1.0', 'daily');
        $sitemap->add(route('introduce'), \Carbon\Carbon::now(), '1.0', 'daily');
        $sitemap->add(route('tacgia.list'), \Carbon\Carbon::now(), '1.0', 'daily');

        // add bài viết
        $posts = \App\baiviets::where('status', 1)->get();
        foreach ($posts as $post) {
            $sitemap->add(route('detail.baiviet', [$post->slug]), $post->created_at, '0.6', 'daily');
        }

        // lưu file và phân quyền
        $sitemap->store('xml', 'sitemap');
        if (File::exists(base_path('sitemap.xml'))) {
            chmod(base_path('sitemap.xml'), 0777);
        }
    }
}
