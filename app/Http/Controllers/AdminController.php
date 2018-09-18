<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAccountAdminRequest;
use App\Http\Requests\UpdateAccountUserRequest;
use App\Http\Requests\UpdateInfoAdminRequest;
use App\Http\Requests\UpdateInforUserRequest;
use App\Http\Requests\UserRequest;
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

    /**
     * @function update info admin
     * @param UpdateInfoAdminRequest $request
     * @return mixed
     */
    public function update_info_admin(UpdateInfoAdminRequest $request) {
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

    /**
     * @function update account admin
     * @param UpdateAccountAdminRequest $request
     * @return mixed
     */
    public function update_account_admin(UpdateAccountAdminRequest $request) {
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
     * @function update info user
     * @param UpdateInforUserRequest $request
     * @return mixed
     */
    public function update_info_user(UpdateInforUserRequest $request, $id) {
        try {
            $u = users::findOrFail($id);
            $u->name = $request->name;
            $u->intro = $request->intro;
            $u->id_loaithanhvien = $request->id_loaithanhvien;
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($avatar)->save(base_path($path));
                $u->avatar = '/' . $path;
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
                $u->background = '/' . $path;
            }
            $u->save();
            return route('admin.user.detail', ['id' => $id])->with('success', 'Cập nhật thông tin người dùng thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return route('admin.user.detail', ['id' => $id])->with('error', 'Lỗi, cập nhật thông tin người dùng thất bại!');
        }
    }

    /**
     * @function update account user
     * @param UpdateAccountUserRequest $request
     * @return mixed
     */
    public function update_account_user(UpdateAccountUserRequest $request, $id) {
        try {
            $ad = users::findOrFail($id);
            $ad->email = $request->email;
            $ad->password = bcrypt($request->password);
            $ad->save();
            return route('admin.user.detail', ['id' => $id])->with('success', 'Cập nhật tài khoản người dùng thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return route('admin.user.detail', ['id' => $id])->with('error', 'Lỗi, cập nhật tài khoản người dùng thất bại!');
        }
    }

    /**
     * @function insert new user
     * @param UserRequest $request
     * @return mixed
     */
    public function insert_user(UserRequest $request) {
        try {
            $u = new users();
            $u->username = substr(md5(microtime()), rand(0, 15), 15);
            $u->name = $request->name;
            $u->intro = $request->intro;
            $u->id_loaithanhvien = $request->id_loaithanhvien;
            $u->email = $request->email;
            $u->password = bcrypt($request->password);
            $u->status = $request->status;
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                $dir = 'uploads/users/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($avatar)->save(base_path($path));
                $u->avatar = '/' . $path;
            }
            if ($request->hasFile('background')) {
                $bg = $request->file('background');
                $filename = time() . '.' . $bg->getClientOriginalExtension();
                $dir = 'uploads/users/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($bg)->save(base_path($path));
                $u->background = '/' . $path;
            }
            $u->save();
            return route('admin.user.list')->with('success', 'Thêm mới người dùng thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return route('admin.user.list')->with('error', 'Lỗi, thêm mới người dùng thất bại!');
        }
    }

    /**
     * @function delete user
     * @param $id
     * @return mixed
     */
    public function delete_user($id) {
        try {
            $u = users::findOrFail($id);
            //Delete all baiviet cua user
            $list_bv = baiviets::where('username', $u->username)->get();
            if(!is_null($list_bv)) {
                foreach ($list_bv as $l) {
                    $b = baiviets::findOrFail($l->id);
                    File::delete(($b->thumn));
                    File::delete(($b->background));
                    $b->delete();
                }
            }
            //delete user
            File::delete(($u->avatar));
            File::delete(($u->background));
            $u->delete();
            return route('admin.user.list')->with('success', 'Xóa người dùng thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return route('admin.user.list')->with('error', 'Lỗi, xóa người dùng thất bại!');
        }
    }

    /**
     * @function block account user
     */
    public function block_account_user($id) {
        //block account user
        $u = users::findOrFail($id);
        $u->status = -1;
        $u->save();

        //block all baiviet cua user
        $count = 0;
        $list = baiviets::where('username', $u->username)->get();
        if(!is_null($list)) {
            foreach ($list as $l) {
                $b = baiviets::findOrFail($l->id);
                if($b->status != -1) {
                    $b->status = -1;
                    $b->save();
                    $count++;
                }
            }
        }
        echo array('status' => 'success', 'ms' => 'Block tài khoản '.$u->email.' thành công. Có '.$count.'/'.count($list).' bài viết đã khóa kèm theo!');
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
