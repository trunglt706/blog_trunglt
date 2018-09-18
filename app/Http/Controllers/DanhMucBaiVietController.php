<?php

namespace App\Http\Controllers;

use App\Http\Requests\DanhMucBaiVietRequest;
use Illuminate\Http\Request;
use App\danhmucbaiviets;
use Illuminate\Support\Facades\Log;
use Exception;

class DanhMucBaiVietController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * @function insert new danhmuc
     * @param DanhMucBaiVietRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function insert(DanhMucBaiVietRequest $request) {
        try {
            $dmuc = new danhmucbaiviets();
            $dmuc->name = $request->name;
            $dmuc->slug = $request->slug;
            $dmuc->intro = $request->intro;
            $dmuc->status = $request->status;
            $dmuc->save();
            return view('admin.danhmuc.list')->with('success', 'Thêm mới danh mục bài viết thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('admin.danhmuc.list')->with('error', 'Lỗi, thêm mới danh mục bài viết thất bại!');
        }
    }

    /**
     * @function update info danhmuc
     * @param DanhMucBaiVietRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(DanhMucBaiVietRequest $request, $id) {
        try {
            $dmuc = danhmucbaiviets::findOrFail($id);
            $dmuc->name = $request->name;
            $dmuc->intro = $request->intro;
            $dmuc->status = $request->status;
            $dmuc->save();
            return view('admin.danhmuc.detail', ['id' => $id])->with('success', 'Cập nhật thông tin danh mục bài viết thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('admin.danhmuc.detail', ['id' => $id])->with('error', 'Lỗi, cập nhật thông tin danh mục bài viết thất bại!');
        }
    }

    /**
     * @function delete danhmuc
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id) {
        try {
            $dmuc = danhmucbaiviets::findOrFail($id);
            $dmuc->delete();
            return view('admin.danhmuc.list')->with('success', 'xóa danh mục bài viết thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('admin.danhmuc.list')->with('error', 'Lỗi, xóa danh mục bài viết thất bại!');
        }
    }
}
