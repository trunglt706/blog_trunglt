<?php

namespace App\Http\Controllers;

use App\baiviets;
use App\danhmucbaiviets;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * @function go to home page
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @function go to contact page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact() {
        return view('contact');
    }

    /**
     * @function get list baiviet
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function danhmuc_baiviet($slug) {
        $dmuc = danhmucbaiviets::where('slug', $slug)->findOrFail();
        $data = baiviets::where('id_danhmuc', $dmuc->id)->orderBy('created_at')->paginate(10);
        return view('danhmuc-baiviet', compact('data'));
    }

    /**
     * @function go to detail baiviet
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function baiviet($slug) {
        $data = baiviets::where('slug', $slug)->findOrFail();
        $data->view += 1;
        $data->save();
        return view('detail-baiviet', compact('data'));
    }

    /**
     * @function go to gioithieu page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gioithieu() {
        return view('gioi-thieu');
    }

    /**
     * @function go to search page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search() {
        return view('search');
    }

    public function searchAjax(Request $request) {

    }
}
