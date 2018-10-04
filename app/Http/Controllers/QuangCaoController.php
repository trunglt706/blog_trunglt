<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuangCaoRequest;
use App\quangcaos;
use Illuminate\Support\Facades\Log;
use Exception;
use File;
use Image;

class QuangCaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @function go to list quangcao
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function quangCao() {
        $object['listqc'] = quangcaos::paginate(10);
        return view('admin.quangcao.list', ['object' => $object]);
    }

    /**
     * @function go to detail quangcao
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function quangCaoChiTiet($id) {
        $data = quangcaos::findOrFail($id);
        return view('admin.quangcao.detail', compact('data'));
    }

    /**
     * @function insert quangcao
     * @param LoaiThanhVienRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function quangCaoInsert(QuangCaoRequest $request) {
        try {
            $qcao = new quangcaos();
            $qcao->name = $request->name;
            $qcao->slug = $request->slug;
            $qcao->intro = $request->intro;
            $qcao->order = $request->order;
            $qcao->status = $request->status;
            if ($request->hasFile('logo')) {
                $loai = $request->file('logo');
                $filename = time() . '.' . $loai->getClientOriginalExtension();
                $dir = 'uploads/quangcaos/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($loai)->save(base_path($path));
                $qcao->logo = $path;
            }
            $qcao->save();
            return redirect()->route('admin.quangcao')->with('success', 'Thêm mới quảng cáo thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.quangcao')->with('error', 'Lỗi, thêm mới quảng cáo thất bại!');
        }
    }

    /**
     * @function update quangcao
     * @param LoaiThanhVienUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function quangCaoUpdate(QuangCaoRequest $request, $id) {
        try {
            $qcao = quangcaos::find($id);
            $qcao->name = $request->name;
            $qcao->slug = $request->slug;
            $qcao->intro = $request->intro;
            $qcao->link = $request->link;
            $qcao->order = $request->order;
            $qcao->status = $request->status;
            if ($request->hasFile('photo')) {
                File::delete($qcao->photo);
                $loai = $request->file('photo');
                $filename = time() . '.' . $loai->getClientOriginalExtension();
                $dir = 'uploads/quangcaos/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($loai)->save(base_path($path));
                $qcao->photo = $path;
            }
            $qcao->save();
            return redirect()->route('admin.quangcao.chitiet', ['id'=>$id])->with('success', 'Cập nhật quảng cáo thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.quangcao.chitiet', ['id'=>$id])->with('error', 'Lỗi, cập nhật quảng cáo thất bại!');
        }
    }

    /**
     * @function delete quangcao
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function quangCaoDelete($id) {
        try {
            $qcao = quangcaos::find($id);
            File::delete($qcao->photo);
            $qcao->delete();
            return redirect()->route('admin.quangcao')->with('success', 'xóa quảng cáo thành công.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.quangcao')->with('error', 'Lỗi, xóa quảng cáo thất bại!');
        }
    }
}
