<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class AdminComposer {
    
    /**
     * The system repository implementation.
     *
     * @var NewletterRepository
     */
    protected $user;
    
    /**
     * Create a new profile composer.
     *
     * @param  SystemRepository  $admin
     * @return void
     */
    public function _construct(SystemRepository $user) {
        $this->user = $user;
    }
    
    public function compose(View $view) {
        $data['user'] = \App\users::findOrFail(auth()->user()->id);
        $view->with('data', $data);
    }
    
}
