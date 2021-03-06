<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\users;
use Exception;
use Illuminate\Support\Facades\Log;
use File;
use Image;

class ThanhVienController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @function go to list user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function thanhVien() {
        $object['thanhvien'] = users::paginate(10);
        return view('admin.user.list', ['object' => $object]);
    }

    /**
     * @function go to detail user
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function thanhVienChiTiet($id) {
        $data = users::findOrFail($id);
        return view('admin.user.detail', compact('data'));
    }

    /**
     * @function update info user
     * @param UpdateInforUserRequest $request
     * @return mixed
     */
    public function thanhVienUpdateInfo(UpdateInforUserRequest $request, $id) {
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
    public function thanhVienUpdateAccount(UpdateAccountUserRequest $request, $id) {
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
    public function thanhVienDelete($id) {
        try {
            $u = users::findOrFail($id);
            //Delete all baiviet cua user
            $list_bv = baiviets::where('username', $u->username)->get();
            if(!is_null($list_bv)) {
                foreach ($list_bv as $l) {
                    $b = baiviets::findOrFail($l->id);
                    File::delete($b->thumn);
                    File::delete($b->background);
                    $b->delete();
                }
            }
            //delete user
            File::delete($u->avatar);
            File::delete($u->background);
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
    public function thanhVienBlock($id) {
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
}
