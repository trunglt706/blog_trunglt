<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\admins;

class AdminComposer {
    
    /**
     * The system repository implementation.
     *
     * @var NewletterRepository
     */
    protected $admin;
    
    /**
     * Create a new profile composer.
     *
     * @param  SystemRepository  $admin
     * @return void
     */
    public function _construct(SystemRepository $admin) {
        $this->admin = $admin;
    }
    
    public function compose(View $view) {
        $data['admin'] = admins::findOrFail(auth()->user()->id);
        $view->with('data', $data);
    }
    
}
