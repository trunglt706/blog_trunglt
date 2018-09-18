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
        $this->middleware('admin');
    }

    /**
     * @function insert new baiviet
     * @param BaiVietRequest $request
     * @return mixed
     */
    public function insert(BaiVietRequest $request) {
        try {
            $bviet = new baiviets();
            $bviet->id_danhmuc = $request->id_danhmuc;
            $bviet->username = $request->username;
            $bviet->slug = str_slug($request->name, '-');
            $bviet->name = $request->name;
            $bviet->intro = $request->intro;
            $bviet->content = $request->content;
            $bviet->status = $request->status;
            $bviet->keyword = $request->keyword;
            $bviet->important = isset($request->important) ? 1 : 0;
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
                $bg = $request->file('background');
                $filename = time() . '.' . $bg->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($bg)->save(base_path($path));
                $bviet->background = '/' . $path;
            }
            $bviet->save();
            return route('admin.baiviet.list')->with('success', 'Thêm mới bài viết thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return route('admin.baiviet.list')->with('error', 'Lỗi, thêm mới bài viết thất bại!');
        }
    }

    /**
     * @function update info baiviet
     * @param BaiVietRequest $request
     * @param $id
     * @return mixed
     */
    public function update(BaiVietRequest $request, $id) {
        try {
            $bviet = baiviets::findOrFail($id);
            $bviet->id_danhmuc = $request->id_danhmuc;
            $bviet->name = $request->name;
            $bviet->intro = $request->intro;
            $bviet->content = $request->content;
            $bviet->status = $request->status;
            $bviet->keyword = $request->keyword;
            $bviet->important = isset($request->important) ? 1 : 0;
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
                $bg = $request->file('background');
                $filename = time() . '.' . $bg->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($bg)->save(base_path($path));
                $bviet->background = '/' . $path;
            }
            $bviet->save();
            return route('admin.baiviet.detail', ['id' => $id])->with('success', 'Cập nhật bài viết thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return route('admin.baiviet.detail', ['id' => $id])->with('error', 'Lỗi, cập nhật bài viết thất bại!');
        }
    }

    /**
     * @function delete baiviet
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id) {
        $bviet = baiviets::findOrFail($id);
        try {
            File::delete(($bviet->thumn));
            File::delete(($bviet->background));
            $bviet->delete();
            return redirect()->route("admin.baiviet.list")->with("success", "Xóa bài viết thành công");
        } catch (\Exception $ex) {
            return redirect()->route("admin.baiviet.list")->with("error", "Xóa bài viết thất bại!");
        }
    }
}
