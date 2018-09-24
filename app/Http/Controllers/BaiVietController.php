<?php

namespace App\Http\Controllers;

use App\Http\Requests\BaiVietRequest;
use App\baiviets;
use Image;
use File;
use Illuminate\Support\Facades\Log;
use Exception;

class BaiVietController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @function go to list baiviet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function baiViet() {
        $object['listbv'] = baiviets::paginate(10);
        return view('admin.baiviet.list', ['object' => $object]);
    }

    /**
     * @function go to detail baiviet
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function baiVietChiTiet($id) {
        $data = baiviets::findOrFail($id);
        return view('admin.baiviet.detail', compact('data'));
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
            $bviet->username = auth()->user()->id;
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
                $bviet->thumn = '/' . $path;
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
                $bviet->background = '/' . $path;
            }
            $bviet->save();
            return redirect()->route('admin.baiviet')->with('success', 'Thêm bài viết mới thành công.');
        } catch(Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.baiviet')->with('error', 'Lỗi, thêm bài viết mới thất bại!');
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
                $thumn = $request->file('thumn');
                $filename = time() . '.' . $thumn->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($thumn)->save(base_path($path));
                $bviet->thumn = '/' . $path;
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
                $bviet->background = '/' . $path;
            }
            $bviet->save();
            return redirect()->route('admin.baiviet.chitiet', ['id' => $id])->with('success', 'Cập nhật thông tin bài viết thành công.');
        } catch(Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.baiviet.chitiet', ['id' => $id])->with('error', 'Lỗi, cập nhật thông tin bài viết thất bại!');
        }
    }

    /**
     * @function xoa bai viet
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function baiVietDelete($id) {
        try {
            $bviet = baiviets::find($id);
            File::delete($bviet->thumn);
            File::delete($bviet->thumn);
            $bviet->delete();
            return redirect()->route('admin.baiviet')->with('success', 'Xóa bài viết thất bại!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.baiviet')->with('error', 'Lỗi, xóa bài viết thất bại!');
        }
    }
}
