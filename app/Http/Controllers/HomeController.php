<?php

namespace App\Http\Controllers;

use App\baiviets;
use App\danhmucbaiviets;
use App\Http\Requests\NhanBaiVietRequest;
use App\nhanbaiviets;
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

    /**
     * @function post data by ajax
     * @param Request $request
     */
    public function searchAjax(Request $request) {
        $data = baiviets::where("name", "like", "%".$request->key."%")
                        ->where("keyword", "like", "%".$request->key."%")
                        ->where("status", 1)
                        ->orderBy('created_at')->paginate(10);
        echo $data;
    }

    /**
     * @function dang ky nhan bai viet by ajax
     * @param NhanBaiVietRequest $request
     */
    public function dangky_nhanbaiviet(NhanBaiVietRequest $request) {
        try {
            $nhan = new nhanbaiviets();
            $nhan->email = $request->email;
            $nhan->save();
            echo ['status' => 'success', 'ms' => 'Đăng ký nhận bài viết thành công'];
        } catch (Exception $e) {
            Log::error($e->getMessage());
            echo ['status' => 'success', 'ms' => 'Lỗi, đăng ký nhận bài viết thất bại!'];
        }
    }
}
