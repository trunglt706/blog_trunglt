<?php

namespace App\Http\ViewComposers;

use App\cauhinhchungs;
use App\visitors;
use Illuminate\View\View;

use Jenssegers\Agent\Agent;

class HomeComposer
{

    /**
     * The system repository implementation.
     *
     * @var NewletterRepository
     */
    protected $home;

    /**
     * Create a new profile composer.
     *
     * @param  SystemRepository $home
     * @return void
     */
    public function _construct(SystemRepository $home)
    {
        $this->home = $home;
    }

    public function compose(View $view)
    {
        $data['intro'] = cauhinhchungs::getHeThong("slug", "intro-website");
        $data['keyword'] = cauhinhchungs::getHeThong("slug", "keyword-website");
        $data['title'] = cauhinhchungs::getHeThong("slug", "ten-website");
        $data['logo'] = cauhinhchungs::getHeThong("slug", "logo-website");
        $data['tagline'] = cauhinhchungs::getHeThong("slug", "tagline-website");
        $data['facebook'] = cauhinhchungs::getHeThong("slug", "link-facebook");
        $data['youtube'] = cauhinhchungs::getHeThong("slug", "link-youtube");
        $data['email'] = cauhinhchungs::getHeThong("slug", "email-website");

        $visit = new visitors();
        $data['countVisitor'] = $visit->countVisitor();

        $agent = new Agent();
        $data['agent'] = $agent;
        
        $view->with('data', $data);
    }

}
