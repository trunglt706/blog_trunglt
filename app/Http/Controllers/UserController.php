<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\users;
use Image;
use File;
use Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function insert(Request $request) {

    }

    public function update(Request $request) {

    }

    public function delete($id) {

    }
}
