<?php

namespace App\Http\Controllers;

use App\Http\Requests\DanhMucBaiVietRequest;
use App\danhmucbaiviets;
use Illuminate\Support\Facades\Log;
use Exception;

class DanhMucBaiVietController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @function go to list danhmuc baiviet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function danhMuc() {
        $object['danhmuc'] = danhmucbaiviets::paginate(10);
        return view('admin.danhmuc-baiviet.list', ['object' => $object]);
    }

    /**
     * @function go to detail danhmuc baiviet
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function danhMucChiTiet($id) {
        $data = danhmucbaiviets::findOrFail($id);
        return view('admin.danhmuc-baiviet.detail', compact('data'));
    }

    /**
     * @function insert danh muc bai viet
     * @param DanhMucBaiVietRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function danhMucInsert(DanhMucBaiVietRequest $request) {
        try {
            $dmuc = new danhmucbaiviets();
            $dmuc->name = $request->name;
            $dmuc->slug = $request->slug;
            $dmuc->intro = $request->intro;
            $dmuc->status = $request->status;
            $dmuc->save();
            return redirect()->route('admin.danhmuc')->with('success', 'Thêm mới danh mục bài viết thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.danhmuc')->with('error', 'Lỗi, thêm mới danh mục bài viết thất bại!');
        }
    }

    /**
     * @function update danh muc bai viet
     * @param DanhMucUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function danhMucUpdate(DanhMucUpdateRequest $request, $id) {
        try {
            $dmuc = danhmucbaiviets::find($id);
            $dmuc->name = $request->name;
            $dmuc->slug = $request->slug;
            $dmuc->intro = $request->intro;
            $dmuc->status = $request->status;
            $dmuc->save();
            return redirect()->route('admin.danhmuc.chitiet', ['id' => $id])->with('success', 'cập nhật thông tin danh mục bài viết thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.danhmuc.chitiet', ['id' => $id])->with('error', 'Lỗi, cập nhật thông tin danh mục bài viết thất bại!');
        }
    }

    /**
     * @function delete danh muc bai viet
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function danhMucDelete($id) {
        try {
            $dmuc = danhmucbaiviets::find($id);
            $dmuc->delete();
            return redirect()->route('admin.danhmuc')->with('success', 'xóa danh mục bài viết thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.danhmuc')->with('error', 'Lỗi, xóa danh mục bài viết thất bại!');
        }
    }
}
