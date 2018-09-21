<?php

namespace App\Http\Controllers;

use App\baiviets;
use App\danhmucbaiviets;
use App\hoidap;
use App\Http\Requests\NhanBaiVietRequest;
use App\nhanbaiviets;
use App\quangcaos;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\LoginRequest;

class HomeController extends Controller
{

    /**
     * @function go to home page
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get 5 lasted news
        $data['news'] = baiviets::orderBy('created_at')->limit(5)->get();
        //get news important
        $data['important'] = baiviets::where('important', 1)->first();
        //get 2 advs
        $data['advs'] = quangcaos::orderBy('status', 'asc')->limit(2)->get();
        return view('home', compact('data'));
    }

    /**
     * @function go to contact page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact() {
        return view('contact');
    }

    /**
     * @function go to answer and question page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function hoidap() {
        //Get list hoidap
        $data['hoidap'] = hoidap::where('status', 1)->orderBy('order', 'asc')->get();
        return view('hoidap', compact('data'));
    }

    /**
     * @function get list baiviet
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function danhmuc_baiviet($slug) {
        //Lay chi tiet danh muc bai viet
        $data['danhmuc'] = danhmucbaiviets::where('slug', $slug)->where('status', 1)->first();
        //Lay danh sach bai viet cua danh muc
        $data['list_baiviet'] = baiviets::where('id_danhmuc', $data['danhmuc']->id)->where('status', 1)->orderBy('created_at')->paginate(10);
        //Lay danh sach 5 bai viet co luot view cao nhat
        $data['list_view'] = baiviets::where('status', 1)->orderBy('view', 'desc')->limit(5);
        return view('danhmuc-baiviet', compact('data'));
    }

    /**
     * @function go to detail baiviet
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function baiviet($slug) {
        $data = baiviets::where('slug', $slug)->first();
        $data->view += 1;
        $data->save();
        return view('detail-baiviet', compact('data'));
    }

    /**
     * @function go to gioithieu page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function introduce() {
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
