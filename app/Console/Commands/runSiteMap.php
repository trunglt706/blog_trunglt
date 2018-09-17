<?php

namespace App\Console\Commands;

use App\danhmucbaiviets;
use Illuminate\Console\Command;
use Carbon\Carbon;
use File;

class runSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle()
    {
        $sitemap = \App::make('sitemap');
        // add home pages mặc định
        $sitemap->add(route('home'), \Carbon\Carbon::now(), '1.0', 'daily');
        $sitemap->add(route('introduce'), \Carbon\Carbon::now(), '1.0', 'daily');

        // add bài viết
        $posts = danhmucbaiviets::all();
        foreach ($posts as $post) {
            $sitemap->add(route('baiviet', [$post->slug]), $post->slug, '0.6', 'daily');
        }

        // lưu file và phân quyền
        $sitemap->store('xml', 'sitemap');
        if (File::exists(public_path() . '/sitemap.xml')) {
            chmod(public_path() . '/sitemap.xml', 0777);
        }
    }
}
