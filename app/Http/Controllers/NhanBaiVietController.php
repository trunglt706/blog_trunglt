<?php

namespace App\Http\Controllers;

use App\Http\Requests\NhanBaiVietRequest;
use Illuminate\Http\Request;
use App\nhanbaiviets;
use Illuminate\Support\Facades\Log;
use Exception;

class NhanBaiVietController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * @function insert new nhan bai viet
     * @param NhanBaiVietRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function insert(NhanBaiVietRequest $request) {
        try {
            $nhan = new nhanbaiviets();
            $nhan->email = $request->email;
            $nhan->status = $request->status;
            $nhan->save();
            return view('admin.nhanbaiviet.list')->with('success', 'Thêm mới nhận đăng ký bài viết thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('admin.nhanbaiviet.list')->with('error', 'Lỗi, thêm mới nhận đăng ký bài viết thất bại!');
        }
    }

    /**
     * @function update info nhan bai viet
     * @param NhanBaiVietRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(NhanBaiVietRequest $request, $id) {
        try {
            $nhan = nhanbaiviets::findOrFail($id);
            $nhan->email = $request->email;
            $nhan->status = $request->status;
            $nhan->save();
            return view('admin.nhanbaiviet.detail', ['id' => $id])->with('success', 'Cập nhật thông tin nhận đăng ký bài viết thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('admin.nhanbaiviet.detail', ['id' => $id])->with('success', 'Lỗi, cập nhật thông tin nhận đăng ký bài viết thất bại!');
        }
    }

    /**
     * @function delete nhan bai viet
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id) {
        try {
            $nhan = nhanbaiviets::findOrFail($id);
            $nhan->delete();
            return view('admin.nhanbaiviet.list')->with('success', 'Xóa thông tin nhận đăng ký bài viết thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('admin.nhanbaiviet.list')->with('error', 'Lỗi, xóa thông tin nhận đăng ký bài viết thất bại!');
        }
    }
}
