<?php

namespace App\Http\Controllers;

use App\baiviets;
use App\Http\Requests\UpdateAccountUserRequest;
use App\Http\Requests\UpdateInforUserRequest;
use App\users;
use Image;
use File;
use Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }

    /**
     * @function logout
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('home');
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
     * @function block account
     */
    public function block_account() {
        //block account user
        $u = users::findOrFail(auth()->user()->id);
        $u->status = -1;
        $u->save();

        //block all baiviet cua user
        $count = 0;
        $list = baiviets::where('username', auth()->user()->username)->get();
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
        echo array('status' => 'success', 'ms' => 'Block tài khoản thành công. Có '.$count.'/'.count($list).' bài viết đã khóa kèm theo!');
    }

    /**
     * @function go to detail baiviet
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function baiviet($id) {
        $data = baiviets::where('id', $id)->where('username', auth()->user()->username)->first();
        return view('user.baiviet.detail', compact('data'));
    }

    /**
     * @function go to list baiviet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list_baiviet() {
        $data = baiviets::where('username', auth()->user()->username)->get();
        return view('user.baiviet.list', compact('data'));
    }
}
