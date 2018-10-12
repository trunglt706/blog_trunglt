<?php

namespace App\Http\Controllers;

use App\baiviets;
use App\Http\Requests\BaiVietRequest;
use App\Http\Requests\UpdateAccountUserRequest;
use App\Http\Requests\UserUpdateInfoRequest;
use App\users;
use App\danhmucbaiviets;
use Image;
use File;
use Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth:web');
        $this->middleware(['activated'], ['except' => ['logout', 'index']]);
    }

    /**
     * @function go to home page of user
     * @return view
     */
    public function index() {
        //Get sum baiviet
        $object['tong'] = baiviets::where('username', auth()->user()->username)->count();
        //Get sum baiviet da duyet
        $object['da_duyet'] = baiviets::where('username', auth()->user()->username)->where('status', 1)->count();
        //Get sum baiviet chua duyet
        $object['cho_duyet'] = baiviets::where('username', auth()->user()->username)->where('status', 0)->count();
        //Get sum baiviet dang khoa
        $object['block'] = baiviets::where('username', auth()->user()->username)->where('status', -1)->count();
        return view('user.home', ['object' => $object]);
    }

    /**
     * @function logout
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {
        try {
            $email = auth()->user()->email;
            Auth::guard('web')->logout();
            \Slack::send('[User Logout] - Success '.$email);
            return redirect()->route('login')->with('success', 'Đăng xuất thành công');
        } catch (Exception $ex) {
            \Slack::send('[User Logout] - '.$ex->getMessage());
        }
    }

    //================================== INFOR USER ==================================//
    /**
     * @function go to account page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile() {
        return view('user.profile');
    }

    /**
     * @function update info user
     * @param UpdateInforUserRequest $request
     * @return mixed
     */
    public function inforUpdate(UserUpdateInfoRequest $request) {
        try {
            $u = users::findOrFail(auth()->user()->id);
            $u->name = $request->name;
            $u->intro = $request->intro;
            if ($request->hasFile('avatar')) {
                File::delete($u->avatar);
                $avatar = $request->file('avatar');
                $filename = 'avatar' . time() . '.' . $avatar->getClientOriginalExtension();
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
                $filename = 'background' . time() . '.' . $bg->getClientOriginalExtension();
                $dir = 'uploads/thanhviens/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($bg)->save(base_path($path));
                $u->background = $path;
            }
            $u->save();
            \Slack::send('[User Update Info] - Success '.auth()->user()->email);
            return redirect()->route('user.profile')->with('success', 'Cập nhật thông tin người dùng thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            \Slack::send('[User Update Info] - '.$e->getMessage());
            return redirect()->route('user.profile')->with('error', 'Lỗi, cập nhật thông tin người dùng thất bại!');
        }
    }

    /**
     * @function update account user
     * @param UpdateAccountUserRequest $request
     * @return mixed
     */
    public function accountUpdate(UpdateAccountUserRequest $request) {
        try {
            $ad = users::findOrFail(auth()->user()->id);
            $ad->password = bcrypt($request->password);
            $ad->save();
            \Slack::send('[User Update Account] - Success '.auth()->user()->email);
            return redirect()->route('user.profile')->with('success', 'Cập nhật tài khoản người dùng thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            \Slack::send('[User Update Account] - '.$e->getMessage());
            return redirect()->route('user.profile')->with('error', 'Lỗi, cập nhật tài khoản người dùng thất bại!');
        }
    }

    /**
     * @function block account
     */
    public function block_account() {
        try {
            //block account user
            $u = users::findOrFail(auth()->user()->id);
            $u->status = -1;
            $u->save();

            //block all baiviet cua user
            $count = 0;
            $list = baiviets::where('username', auth()->user()->username)->get();
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
            \Slack::send('[User Block Account] - Success '.auth()->user()->email);
            echo array('status' => 'success', 'ms' => 'Block tài khoản thành công. Có ' . $count . '/' . count($list) . ' bài viết đã khóa kèm theo!');
        } catch (Exception $ex) {
            \Slack::send('[User Block Account] - '.$ex->getMessage());
            echo [];
        }
    }

    //================================== END INFOR USER ==================================//
    //================================== BAI VIET ==================================//
    /**
     * @function go to detail baiviet
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function baiVietChiTiet($id) {
        $object['bviet'] = baiviets::where('id', $id)->where('username', auth()->user()->username)->where('status', 1)->first();
        $object['list_danhmuc'] = danhmucbaiviets::where('status', 1)->get();
        return view('user.baiviet.detail', ['object' => $object]);
    }

    /**
     * @function go to list baiviet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function baiViet() {
        $object['listbv'] = baiviets::where('username', auth()->user()->username)->where('status', 1)->paginate(10);
        $object['list_danhmuc'] = danhmucbaiviets::where('status', 1)->get();
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
            $bviet->status = 0;
            if ($request->hasFile('thumn')) {
                $thumn = $request->file('thumn');
                $filename = 'thum' . time() . '.' . $thumn->getClientOriginalExtension();
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
                $filename = 'background' . time() . '.' . $background->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($background)->save(base_path($path));
                $bviet->background = $path;
            }
            $bviet->save();
            \Slack::send('[User Insert Bài Viết] - Success '.auth()->user()->email);
            return redirect()->route('user.baiviet')->with('success', 'Thêm bài viết mới thành công.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            \Slack::send('[User Insert Bài Viết] - '.$e->getMessage());
            return redirect()->route('user.baiviet')->with('error', 'Lỗi, thêm bài viết mới thất bại!');
        }
    }

    /**
     * @function update bai viet
     * @param BaiVietUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function baiVietUpdate(BaiVietRequest $request, $id) {
        try {
            $bviet = baiviets::where('id', $id)->where('username', auth()->user()->username)->first();
            $bviet->id_danhmuc = $request->id_danhmuc;
            $bviet->name = $request->name;
            $bviet->intro = $request->intro;
            $bviet->content = $request['content'];
            $bviet->keyword = $request->keyword;
            if ($request->hasFile('thumn')) {
                File::delete($bviet->thumn);
                $thumn = $request->file('thumn');
                $filename = 'thumn' . time() . '.' . $thumn->getClientOriginalExtension();
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
                $filename = 'background' . time() . '.' . $background->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($background)->save(base_path($path));
                $bviet->background = $path;
            }
            $bviet->save();
            \Slack::send('[User Update Bài Viết] - Success '.auth()->user()->email);
            return redirect()->route('user.baiviet.chitiet', ['id' => $id])->with('success', 'Cập nhật thông tin bài viết thành công.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            \Slack::send('[User Update Bài Viết] - '.$e->getMessage());
            return redirect()->route('user.baiviet.chitiet', ['id' => $id])->with('error', 'Lỗi, cập nhật thông tin bài viết thất bại!');
        }
    }

    /**
     * @function xoa bai viet
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function baiVietDelete($id) {
        try {
            $bviet = baiviets::where('id', $id)->where('username', auth()->user()->username)->first();
            File::delete($bviet->thumn);
            File::delete($bviet->background);
            $bviet->delete();
            \Slack::send('[User Delete Bài Viết] - Success '.auth()->user()->email);
            return redirect()->route('user.baiviet')->with('success', 'Xóa bài viết thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            \Slack::send('[User Delete Bài Viết] - '.$e->getMessage());
            return redirect()->route('user.baiviet')->with('error', 'Lỗi, xóa bài viết thất bại!');
        }
    }

    //================================== END BAI VIET ==================================//
    //================================== PHAN TICH DU LIEU ==================================//
    /**
     * @function go to annalytics page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function phanTichDuLieu() {
        return view('user.phantich.index');
    }

    //================================== END PHAN TICH DU LIEU ==================================//
}
