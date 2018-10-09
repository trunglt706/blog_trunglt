<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAccountAdminRequest;
use App\Http\Requests\UpdateInfoAdminRequest;
use App\admins;
use App\baiviets;
use App\lienhe;
use App\nhanbaiviets;
use App\users;
use Image;
use File;
use Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class AdminController extends Controller {

    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * @function go to index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        //lay tong so luong thanh vien chua duyet
        $object['thanhviens'] = users::where('status', 0)->count();
        //Lay tong so bai viet chua duyet
        $object['baiviets'] = baiviets::where('status', 0)->count();
        //lay tong so lien he chua duyet
        $object['lienhes'] = lienhe::where('status', 0)->count();
        //Lay tong so dang ky nhan bai viet
        $object['nhanbaiviets'] = nhanbaiviets::count();

        return view('admin.home', ['object' => $object]);
    }

    /**
     * @function logout
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {
        try {
            admins::updateStatus(auth()->user()->id);
            Auth::guard('admin')->logout();
            return redirect()->route('login.admin')->with('success', 'Đăng xuất hệ thống thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.index')->with('error', 'Lỗi, hệ thống không lấy được dữ liệu! Vui lòng thử lại.');
        }
    }

    //======================================================= Profile
    /**
     * @function go to account page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile() {
        //Lay ds bai viet cua admin
        $list_bviet = baiviets::where('username', auth()->user()->username)->where('status', 1)->paginate(5);
        return view('admin.profile', ['list_bviet' => $list_bviet]);
    }

    /**
     * @function update info admin
     * @param UpdateInfoAdminRequest $request
     * @return mixed
     */
    public function inforUpdate(UpdateInfoAdminRequest $request) {
        try {
            $ad = admins::find(auth()->user()->id);
            $ad->name = $request->name;
            $ad->email = $request->email;
            $ad->intro = $request->intro;
            if ($request->hasFile('avatar')) {
                File::delete($ad->avtar);
                $avatar = $request->file('avatar');
                $filename = 'avatar' . time() . '.' . $avatar->getClientOriginalExtension();
                $dir = 'uploads/admins/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($avatar)->save(base_path($path));
                $ad->avatar = $path;
            }
            if ($request->hasFile('background')) {
                File::delete($ad->background);
                $bg = $request->file('background');
                $filename = 'background' . time() . '.' . $bg->getClientOriginalExtension();
                $dir = 'uploads/admins/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($bg)->save(base_path($path));
                $ad->background = $path;
            }
            $ad->save();
            return redirect()->route('admin.profile')->with('success', 'Cập nhật thông tin admin thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.profile')->with('error', 'Lỗi, cập nhật thông tin admin thất bại!');
        }
    }

    /**
     * @function update account admin
     * @param UpdateAccountAdminRequest $request
     * @return mixed
     */
    public function accountUpdate(UpdateAccountAdminRequest $request) {
        try {
            $ad = admins::find(auth()->user()->id);
            $ad->password = bcrypt($request->password);
            $ad->save();
            Auth::guard('admin')->logout();
            return redirect()->route('login')->with('success', 'Cập nhật tài khoản thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.profile')->with('error', 'Lỗi, cập nhật tài khoản admin thất bại!');
        }
    }

    /**
     * @function go to annalytics page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function phanTichDuLieu() {
        return view('admin.phantich.index');
    }

}
