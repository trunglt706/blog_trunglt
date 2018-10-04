<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoaiThanhVienRequest;
use App\loaithanhviens;
use Illuminate\Support\Facades\Log;
use Exception;
use File;
use Image;

class LoaiThanhVienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @function go to list loai thanhvien
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loaiThanhVien() {
        $object['loaitv'] = loaithanhviens::paginate(10);
        return view('admin.loai-thanhvien.list', ['object' => $object]);
    }

    /**
     * @function go to detail loai thanhvien
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loaiThanhVienChiTiet($id) {
        $object['loaitv'] = loaithanhviens::findOrFail($id);
        return view('admin.loai-thanhvien.detail', ['object' => $object]);
    }

    /**
     * @function insert loai thanh vien
     * @param LoaiThanhVienRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loaiThanhVienInsert(LoaiThanhVienRequest $request) {
        try {
            $loaitv = new loaithanhviens();
            $loaitv->name = $request->name;
            $loaitv->slug = str_slug($request->name, '-');
            $loaitv->intro = $request->intro;
            $loaitv->mark = $request->mark;
            $loaitv->status = $request->status;
            if ($request->hasFile('logo')) {
                $loai = $request->file('logo');
                $filename = time() . '.' . $loai->getClientOriginalExtension();
                $dir = 'uploads/loaithanhviens/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($loai)->save($path);
                $loaitv->logo = $path;
            }
            $loaitv->save();
            return redirect()->route('admin.loaithanhvien')->with('success', 'Thêm mới loại thành viên thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.loaithanhvien')->with('error', 'Lỗi, thêm mới loại thành viên thất bại!');
        }
    }

    /**
     * @function update loai thah vien
     * @param LoaiThanhVienUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loaiThanhVienUpdate(LoaiThanhVienRequest $request, $id) {
        try {
            $loaitv = loaithanhviens::find($id);
            $loaitv->name = $request->name;
            $loaitv->intro = $request->intro;
            $loaitv->mark = $request->mark;
            $loaitv->status = $request->status;
            if ($request->hasFile('logo')) {
                File::delete($loaitv->logo);
                $loai = $request->file('logo');
                $filename = time() . '.' . $loai->getClientOriginalExtension();
                $dir = 'uploads/loaithanhviens/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($loai)->save($path);
                $loaitv->logo = $path;
            }
            $loaitv->save();
            return redirect()->route('admin.loaithanhvien.chitiet', ['id'=>$id])->with('success', 'Cập nhật loại thành viên thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.loaithanhvien.chitiet', ['id'=>$id])->with('error', 'Lỗi, cập nhật loại thành viên thất bại!');
        }
    }

    /**
     * @function delete loai thanh vien
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loaiThanhVienDelete($id) {
        try {
            $loaitv = loaithanhviens::find($id);
            File::delete($loaitv->logo);
            $loaitv->delete();
            return redirect()->route('admin.loaithanhvien')->with('success', 'xóa loại thành viên thành công.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.loaithanhvien')->with('error', 'Lỗi, xóa loại thành viên thất bại!');
        }
    }
}
