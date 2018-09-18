<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAccountAdminRequest;
use App\Http\Requests\UpdateInfoAdminRequest;
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
use Illuminate\Support\Facades\Log;
use Exception;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * @function go to index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('admin.home');
    }

    /**
     * @function go to account page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function account() {
        return view('admin.account');
    }

    public function updateInforAdmin(UpdateInfoAdminRequest $request) {
        try {
            $ad = new admins();
            $ad->name = $request->name;
            $ad->intro = $request->intro;
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($avatar)->save(base_path($path));
                $ad->avatar = '/' . $path;
            }
            if ($request->hasFile('background')) {
                $bg = $request->file('background');
                $filename = time() . '.' . $bg->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($bg)->save(base_path($path));
                $ad->background = '/' . $path;
            }
            $ad->save();
            return route('admin.info')->with('success', 'Cập nhật thông tin admin thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return route('admin.info')->with('error', 'Lỗi, cập nhật thông tin admin thất bại!');
        }
    }

    public function updateAccountAdmin(UpdateAccountAdminRequest $request) {
        try {
            $ad = new admins();
            $ad->email = $request->email;
            $ad->password = bcrypt($request->password);
            $ad->save();
            return route('admin.info')->with('success', 'Cập nhật tài khoản admin thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return route('admin.info')->with('error', 'Lỗi, cập nhật tài khoản admin thất bại!');
        }
    }

    /**
     * @function go to detail baiviet
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function baiviet($id) {
        $data = baiviets::findOrFail($id);
        return view('admin.baiviet.detail', compact('data'));
    }

    /**
     * @function go to list baiviet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list_baiviet() {
        $data = baiviets::all();
        return view('admin.baiviet.list', compact('data'));
    }

    /**
     * @function go to list cauhinhchung
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list_cauhinhchung() {
        $data = cauhinhchungs::all();
        return view('admin.cauhinhchung.list', compact('data'));
    }

    /**
     * @function go to detail cauhinhchung
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cauhinhchung($id) {
        $data = cauhinhchungs::findOrFail($id);
        return view('admin.cauhinhchung.detail', compact('data'));
    }

    /**
     * @function go to list danhmuc baiviet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list_danhmuc() {
        $data = danhmucbaiviets::all();
        return view('admin.danhmuc-baiviet.list', compact('data'));
    }

    /**
     * @function go to detail danhmuc baiviet
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function danhmuc($id) {
        $data = danhmucbaiviets::findOrFail($id);
        return view('admin.danhmuc-baiviet.detail', compact('data'));
    }

    /**
     * @function go to list gopy
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list_gopy() {
        $data = gopys::all();
        return view('admin.gopy.list', compact('data'));
    }

    /**
     * @function go to detail gopy
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gopy($id) {
        $data = gopys::findOrFail($id);
        return view('admin.gopy.detail', compact('data'));
    }

    /**
     * @function go to list loai thanhvien
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list_loai_thanhvien() {
        $data = loaithanhviens::all();
        return view('admin.loai-thanhvien.list', compact('data'));
    }

    /**
     * @function go to detail loai thanhvien
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loai_thanhvien($id) {
        $data = loaithanhviens::findOrFail($id);
        return view('admin.loai-thanhvien.detail', compact('data'));
    }

    /**
     * @function go to list nhan baiviet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list_nhan_baiviet() {
        $data = nhanbaiviets::all();
        return view('admin.nhan-baiviet.list', compact('data'));
    }

    /**
     * @function go to detail nhan baiviet
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function nhan_baiviet($id) {
        $data = nhanbaiviets::findOrFail($id);
        return view('admin.nhan-baiviet.detail', compact('data'));
    }

    /**
     * @function go to list phanhoi
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list_phanhoi() {
        $data = phanhois::all();
        return view('admin.phanhoi.list', compact('data'));
    }

    /**
     * @function go to detail phanhoi
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function phanhoi($id) {
        $data = phanhois::findOrFail($id);
        return view('admin.phanhoi.detail', compact('data'));
    }

    /**
     * @function go to list research
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list_research() {
        $data = researchs::all();
        return view('admin.research.list', compact('data'));
    }

    /**
     * @function go to detail research
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function research($id) {
        $data = researchs::findOrFail($id);
        return view('admin.research.detail', compact('data'));
    }

    /**
     * @function go to list user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list_user() {
        $data = users::all();
        return view('admin.user.list', compact('data'));
    }

    /**
     * @function go to detail user
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user($id) {
        $data = users::findOrFail($id);
        return view('admin.user.detail', compact('data'));
    }

    /**
     * @function logout
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('home');
    }
}
