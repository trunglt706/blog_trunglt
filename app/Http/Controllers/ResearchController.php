<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\researchs;

class ResearchController extends Controller
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
