<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
usse \App\Http\Requests\UpdateInforUserRequest;
use App\Http\Requests\UpdateAccountUserRequest;
use App\users;
use App\baiviets;
use App\loaithanhviens;
use Exception;
use Illuminate\Support\Facades\Log;
use File;
use Image;

class ThanhVienController extends Controller {

    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * @function go to list user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function thanhVien() {
        $object['thanhvien'] = users::paginate(10);
        $object['loai_tvien'] = loaithanhviens::where('status', 1)->get();
        return view('admin.user.list', ['object' => $object]);
    }

    /**
     * @function go to detail user
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function thanhVienChiTiet($id) {
        $object['tvien'] = users::findOrFail($id);
        $object['loai_tvien'] = loaithanhviens::where('status', 1)->get();
        return view('admin.user.detail', ['object' => $object]);
    }

    /**
     * @function update info user
     * @param UpdateInforUserRequest $request
     * @return mixed
     */
    public function thanhVienUpdateInfo(UpdateInforUserRequest $request, $id) {
        //Check email exists
        $email = users::where('email', $request->email)->where('id', '<>', $id)->count();
        if($email == 0) {
            try {
                $u = users::findOrFail($id);
                $u->name = $request->name;
                $u->email = $request->email;
                $u->intro = $request->intro;
                $u->id_loaithanhvien = $request->id_loaithanhvien;
                $u->status = $request->status;
                $u->online = isset($request->online) ? 1 : 0;
                if ($request->hasFile('avatar')) {
                    File::delete($u->avatar);
                    $avatar = $request->file('avatar');
                    $filename = 'avatar'.time() . '.' . $avatar->getClientOriginalExtension();
                    $dir = 'uploads/thanhviens/';
                    if (!File::exists($dir)) {
                        File::makeDirectory($dir, $mode = 0777, true, true);
                    }
                    $path = $dir . $filename;
                    Image::make($avatar)->save(base_path($path));
                    $u->avatar = $path;
                }
                if ($request->hasFile('background')) {
                    File::delete($u->background);
                    $bg = $request->file('background');
                    $filename = 'background'.time() . '.' . $bg->getClientOriginalExtension();
                    $dir = 'uploads/thanhviens/';
                    if (!File::exists($dir)) {
                        File::makeDirectory($dir, $mode = 0777, true, true);
                    }
                    $path = $dir . $filename;
                    Image::make($bg)->save(base_path($path));
                    $u->background = $path;
                }
                $u->save();
                \Slack::send('[Member Update Info] - Success: '.auth()->user()->email);
                return redirect()->route('admin.thanhvien.chitiet', ['id' => $id])->with('success', 'Cập nhật thông tin người dùng thành công');
            } catch (Exception $e) {
                Log::error($e->getMessage());
                \Slack::send('[Member Update Info] - '.$e->getMessage());
                return redirect()->route('admin.thanhvien.chitiet', ['id' => $id])->with('error', 'Lỗi, cập nhật thông tin người dùng thất bại!');
            }
        } else {
            return redirect()->route('admin.thanhvien.chitiet', ['id' => $id])->with('error', 'Lỗi, email cập nhật đã tồn tại trong hệ thống!');
        }
    }

    /**
     * @function update account user
     * @param UpdateAccountUserRequest $request
     * @return mixed
     */
    public function thanhVienUpdateAccount(UpdateAccountUserRequest $request, $id) {
        try {
            $ad = users::findOrFail($id);
            $ad->password = bcrypt($request->password);
            $ad->save();
            \Slack::send('[Member Update Account] - Success: '.auth()->user()->email);
            return redirect()->route('admin.thanhvien.chitiet', ['id' => $id])->with('success', 'Cập nhật tài khoản người dùng thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            \Slack::send('[Member Update Account] - '.$e->getMessage());
            return redirect()->route('admin.thanhvien.chitiet', ['id' => $id])->with('error', 'Lỗi, cập nhật tài khoản người dùng thất bại!');
        }
    }

    /**
     * @function insert new user
     * @param UserRequest $request
     * @return mixed
     */
    public function thanhVienInsert(UserRequest $request) {
        try {
            $u = new users();
            $u->username = substr(md5(microtime()), rand(0, 15), 15);
            $u->name = $request->name;
            $u->intro = $request->intro;
            $u->id_loaithanhvien = $request->id_loaithanhvien;
            $u->email = $request->email;
            $u->password = bcrypt($request->password);
            $u->status = $request->status;
            $u->online = isset($request->online) ? 1 : 0;
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $filename = 'avatar'.time() . '.' . $avatar->getClientOriginalExtension();
                $dir = 'uploads/thanhviens/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($avatar)->save(base_path($path));
                $u->avatar = $path;
            }
            if ($request->hasFile('background')) {
                $bg = $request->file('background');
                $filename = 'background'.time() . '.' . $bg->getClientOriginalExtension();
                $dir = 'uploads/thanhviens/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($bg)->save(base_path($path));
                $u->background = $path;
            }
            $u->save();
            \Slack::send('[Member Insert] - Success: '.auth()->user()->email);
            return redirect()->route('admin.thanhvien')->with('success', 'Thêm mới người dùng thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            \Slack::send('[Member Insert] - '.$e->getMessage());
            return redirect()->route('admin.thanhvien')->with('error', 'Lỗi, thêm mới người dùng thất bại!');
        }
    }

    /**
     * @function delete user
     * @param $id
     * @return mixed
     */
    public function thanhVienDelete($id) {
        $count = 0;
        try {
            $u = users::findOrFail($id);
            //Delete all baiviet cua user
            $list_bv = baiviets::where('username', $u->username)->get();
            if (!is_null($list_bv)) {
                foreach ($list_bv as $l) {
                    $b = baiviets::findOrFail($l->id);
                    File::delete($b->thumn);
                    File::delete($b->background);
                    $b->delete();
                    $count++;
                }
            }
            //delete user
            File::delete($u->avatar);
            File::delete($u->background);
            $u->delete();
            \Slack::send('[Member Delete] - Success: '.auth()->user()->email);
            return redirect()->route('admin.thanhvien')->with('success', 'Xóa người dùng thành công ('.$count.' bài viết cũng được xóa theo)');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            \Slack::send('[Member Delete] - '.$e->getMessage());
            return redirect()->route('admin.thanhvien')->with('error', 'Lỗi, xóa người dùng thất bại!');
        }
    }

    /**
     * @function block account user
     */
    public function thanhVienBlock($id) {
        try {
            //block account user
            $u = users::findOrFail($id);
            $u->status = -1;
            $u->save();

            //block all baiviet cua user
            $count = 0;
            $list = baiviets::where('username', $u->username)->get();
            if (!is_null($list)) {
                foreach ($list as $l) {
                    $b = baiviets::findOrFail($l->id);
                    if ($b->status != -1) {
                        $b->status = -1;
                        $b->save();
                        $count++;
                    }
                }
            }
            \Slack::send('[Member Block Account] - Success '.auth()->user()->email);
            echo array('status' => 'success', 'ms' => 'Block tài khoản ' . $u->email . ' thành công. Có ' . $count . '/' . count($list) . ' bài viết đã khóa kèm theo!');
        } catch (Exception $ex) {
            \Slack::send('[Member Delete] - '.$ex->getMessage());
            return [];
        }
    }

}
