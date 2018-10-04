<?php

namespace App\Http\Controllers;

use App\baiviets;
use App\Http\Requests\BaiVietRequest;
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
        $this->middleware('auth:user');
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
                File::delete($u->avatar);
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
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
                $filename = time() . '.' . $bg->getClientOriginalExtension();
                $dir = 'uploads/thanhviens/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($bg)->save(base_path($path));
                $u->background = $path;
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
        $object['bviet'] = baiviets::where('id', $id)->where('username', auth()->user()->username)->first();
        return view('user.baiviet.detail', ['object' => $object]);
    }

    /**
     * @function go to list baiviet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list_baiviet() {
        $object['list_bviet'] = baiviets::where('username', auth()->user()->username)->get();
        return view('user.baiviet.list', ['object' => $object]);
    }
    
    /**
     * @function delete bai viet
     * @param BaiVietRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function baiVietInsert(BaiVietRequest $request) {
        try {
            $bviet = new baiviets();
            $bviet->id_danhmuc = $request->id_danhmuc;
            $bviet->username = auth()->user()->username;
            $bviet->name = $request->name;
            $bviet->slug = str_slug($request->name, '-');
            $bviet->intro = $request->intro;
            $bviet->content = $request['content'];
            $bviet->keyword = $request->keyword;
            $bviet->important = isset($request->important) ? 1 : 0;
            $bviet->rating = $request->rating;
            $bviet->status = $request->status;
            if ($request->hasFile('thumn')) {
                $thumn = $request->file('thumn');
                $filename = time() . '.' . $thumn->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($thumn)->save(base_path($path));
                $bviet->thumn = $path;
            }
            if ($request->hasFile('background')) {
                $background = $request->file('background');
                $filename = time() . '.' . $background->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($background)->save(base_path($path));
                $bviet->background = $path;
            }
            $bviet->save();
            return redirect()->route('user.baiviet.list')->with('success', 'Thêm bài viết mới thành công.');
        } catch(Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('user.baiviet.list')->with('error', 'Lỗi, thêm bài viết mới thất bại!');
        }
    }

    /**
     * @function update bai viet
     * @param BaiVietUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function baiVietUpdate(BaiVietUpdateRequest $request, $id) {
        try {
            $bviet = baiviets::find($id);
            $bviet->id_danhmuc = $request->id_danhmuc;
            $bviet->name = $request->name;
            $bviet->intro = $request->intro;
            $bviet->content = $request['content'];
            $bviet->keyword = $request->keyword;
            $bviet->important = isset($request->important) ? 1 : 0;
            $bviet->rating = $request->rating;
            $bviet->status = $request->status;
            if ($request->hasFile('thumn')) {
                File::delete($bviet->thumn);
                $thumn = $request->file('thumn');
                $filename = time() . '.' . $thumn->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($thumn)->save(base_path($path));
                $bviet->thumn = $path;
            }
            if ($request->hasFile('background')) {
                File::delete($bviet->background);
                $background = $request->file('background');
                $filename = time() . '.' . $background->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($background)->save(base_path($path));
                $bviet->background = $path;
            }
            $bviet->save();
            return redirect()->route('user.baiviet.detail', ['id' => $id])->with('success', 'Cập nhật thông tin bài viết thành công.');
        } catch(Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('user.baiviet.detail', ['id' => $id])->with('error', 'Lỗi, cập nhật thông tin bài viết thất bại!');
        }
    }

    /**
     * @function suppend bai viet
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function baiVietSuppend($id) {
        try {
            $bviet = baiviets::find($id);
            $bviet->status = -1;
            $bviet->save();
            return redirect()->route('user.baiviet.list')->with('success', 'Khóa bài viết thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('user.baiviet.list')->with('error', 'Lỗi, khóa bài viết thất bại!');
        }
    }
}
