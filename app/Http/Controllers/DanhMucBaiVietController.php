<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\danhmucbaiviets;

class DanhMucBaiVietController extends Controller
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
