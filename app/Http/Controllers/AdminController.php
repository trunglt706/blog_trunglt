<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\admins;
use App\baiviets;
use App\cauhinhchungs;
use App\danhmucbaiviets;
use App\gopys;
use App\loaithanhviens;
use App\nhanbaiviets;
use App\phanhois;
use App\researchs;
use App\users;
use Image;
use File;
use Auth;
use Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index() {
        return view('admin.home');
    }
}
