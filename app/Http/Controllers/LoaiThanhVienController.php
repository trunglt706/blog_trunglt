<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoaiThanhVienRequest;
use App\loaithanhviens;
use Illuminate\Support\Facades\Log;
use Exception;

class LoaiThanhVienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @function insert loai thanh vien
     * @param LoaiThanhVienRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function insert(LoaiThanhVienRequest $request) {
        try {
            $loai = new loaithanhviens();
            $loai->slug = $request->slug;
            $loai->name = $request->name;
            $loai->intro = $request->intro;
            $loai->mark = $request->mark;
            $loai->status = $request->status;
            $loai->save();
            return view('admin.loaithanhvien.list')->with('success', 'Thêm mới loại thành viên thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('admin.loaithanhvien.list')->with('error', 'Lỗi, thêm mới loại thành viên thất bại!');
        }
    }

    /**
     * @function update loai thanh vien
     * @param LoaiThanhVienRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(LoaiThanhVienRequest $request, $id) {
        try {
            $loai = loaithanhviens::findOrFail($id);
            $loai->slug = $request->slug;
            $loai->name = $request->name;
            $loai->intro = $request->intro;
            $loai->mark = $request->mark;
            $loai->status = $request->status;
            $loai->save();
            return view('admin.loaithanhvien.detail', ['id' => $id])->with('success', 'Cập nhật thông tin loại thành viên thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('admin.loaithanhvien.detail', ['id' => $id])->with('error', 'Lỗi, cập nhật thông tin loại thành viên thất bại!');
        }
    }

    /**
     * @function delete loai thanh vien
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id) {
        try {
            $loai = loaithanhviens::findOrFail($id);
            $loai->delete();
            return view('admin.loaithanhvien.list')->with('success', 'Xóa loại thành viên thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('admin.loaithanhvien.list')->with('error', 'Lỗi, xóa loại thành viên thất bại!');
        }
    }
}
