<?php

namespace App\Http\Controllers;

use App\Http\Requests\CauHinhChungRequest;
use Illuminate\Http\Request;
use App\cauhinhchungs;
use File;
use Image;
use Illuminate\Support\Facades\Log;
use Exception;

class CauHinhChungController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @function insert new cauhinh
     * @param CauHinhChungRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function insert(CauHinhChungRequest $request) {
        try {
            $chinh = new cauhinhchungs();
            $chinh->slug = $request->slug;
            $chinh->name = $request->name;
            $chinh->intro = $request->intro;
            $chinh->value = $request->value;
            $chinh->save();
            return view('admin.cauhinh.list')->with('success', 'Thêm mới cấu hình thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('admin.cauhinh.list')->with('error', 'Lỗi, thêm mới cấu hình thất bại!');
        }
    }

    /**
     * @function update info cauhinh
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        try {
            $input = $request->only(['ten-website', 'tagline-website', 'logo-website', 'keyword-website', 'intro-website', 'link-facebook', 'email-website', 'link-youtube']);
            foreach ($input as $key => $value) {
                if (($key != "_token") && ($key != "logo-website")) {
                    $chinh = cauhinhchungs::where('slug', $key)->first();
                    $chinh->value = $value;
                    $chinh->save();
                }
            }
            $hethong = cauhinhchungs::where('slug', 'logo-website')->first();
            if ($request->hasFile('logo-website')) {
                if(!is_null($hethong)) {
                    File::delete(($hethong->value));
                }
                $photo = $request->file('logo-website');
                $filename = time() . '.' . $photo->getClientOriginalExtension();
                $dir = 'uploads/hethong/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($photo)->save(base_path($path));
                $hethong->value = '/'.$path;
                $hethong->save();
            }
            return redirect()->route("admin.cauhinh.list")->with("success", "Cập nhật cấu hình thành công");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route("admin.cauhinh.list")->with("error", "Lỗi, cập nhật cấu hình thất bại!");
        }
    }

    /**
     * @function delete cauhinh
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id) {
        try {
            $chinh = cauhinhchungs::findOrFail($id);
            $chinh->delete();
            return redirect()->route("admin.cauhinh.list")->with("success", "Xóa cấu hình thành công");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route("admin.cauhinh.list")->with("error", "Lỗi, xóa cấu hình thất bại!");
        }
    }
}
