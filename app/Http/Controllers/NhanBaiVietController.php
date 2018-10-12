<?php

namespace App\Http\Controllers;

use App\Http\Requests\NhanBaiVietRequest;
use App\nhanbaiviets;
use Illuminate\Support\Facades\Log;
use Exception;

class NhanBaiVietController extends Controller {

    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * @function go to list get newletter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function nhanBaiViet() {
        $object['list_nhanbv'] = nhanbaiviets::paginate(10);
        return view('admin.nhan-baiviet.list', ['object' => $object]);
    }

    /**
     * @function go to detail get newletter
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function nhanBaiVietChiTiet($id) {
        $object['nhan_bviet'] = nhanbaiviets::findOrFail($id);
        return view('admin.nhan-baiviet.detail', ['object' => $object]);
    }

    /**
     * @functio insert get newletter
     * @param NhanBaiVietRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function nhanBaiVietInsert(NhanBaiVietRequest $request) {
        try {
            $nhanbv = new nhanbaiviets();
            $nhanbv->email = $request->email;
            $nhanbv->status = $request->status;
            $nhanbv->save();
            \Slack::send('[Get Newletter Insert] - Success: '.auth()->user()->email);
            return redirect()->route('admin.nhanbaiviet')->with('success', 'Thêm mới thông tin nhận bài viết thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            \Slack::send('[Get Newletter Insert] - '.$e->getMessage());
            return redirect()->route('admin.nhanbaiviet')->with('error', 'Lỗi, thêm mới thông tin nhận bài viết thất bại!');
        }
    }

    /**
     * @function update get newletter
     * @param NhanBaiVietUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function nhanBaiVietUpdate(NhanBaiVietRequest $request, $id) {
        try {
            $nhanbv = nhanbaiviets::find($id);
            $nhanbv->email = $request->email;
            $nhanbv->status = $request->status;
            $nhanbv->save();
            \Slack::send('[Get Newletter Update] - Success: '.auth()->user()->email);
            return redirect()->route('admin.nhanbaiviet.chitiet', ['id' => $id])->with('success', 'Cập nhật thông tin nhận bài viết thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            \Slack::send('[Get Newletter Update] - '.$e->getMessage());
            return redirect()->route('admin.nhanbaiviet.chitiet', ['id' => $id])->with('error', 'Lỗi, cập nhật thông tin nhận bài viết thất bại!');
        }
    }

    /**
     * @function delete get newletter
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function nhanBaiVietDelete($id) {
        try {
            $nhanbv = nhanbaiviets::find($id);
            $nhanbv->delete();
            \Slack::send('[Get Newletter Delete] - Success: '.auth()->user()->email);
            return redirect()->route('admin.nhanbaiviet')->with('success', 'xóa nhận bài viết thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            \Slack::send('[Get Newletter Delete] - '.$e->getMessage());
            return redirect()->route('admin.nhanbaiviet')->with('error', 'Lỗi, xóa nhận bài viết thất bại!');
        }
    }

}
