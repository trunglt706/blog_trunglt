<?php

namespace App\Http\Controllers;

use App\Http\Requests\HoiDapRequest;
use App\hoidap;
use Exception;
use Illuminate\Support\Facades\Log;

class HoiDapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @function go to list hoidap
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function hoiDap() {
        $object['list_hoidap'] = hoidap::paginate(10);
        return view('admin.hoidap.list', ['object' => $object]);
    }

    /**
     * @function go to detail hoidap
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function hoiDapChiTiet($id) {
        $object['hdap'] = hoidap::findOrFail($id);
        return view('admin.hoidap.detail', ['object' => $object]);
    }

    /**
     * @function insert hoidap
     * @param GopYRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function hoiDapInsert(GopYRequest $request) {
        try {
            $hdap = new hoidap();
            $hdap->name = $request->name;
            $hdap->intro = $request->intro;
            $hdap->order = $request->order;
            $hdap->status = $request->status;
            $hdap->save();
            return redirect()->route('admin.hoidap')->with('success', 'Thêm mới hỏi đáp thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.hoidap')->with('error', 'Lỗi, thêm mới hỏi đáp thất bại!');
        }
    }

    /**
     * @function update hoidap
     * @param GopYUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function hoiDapUpdate(HoiDapRequest $request, $id) {
        try {
            $hdap = hoidap::find($id);
            $hdap->name = $request->name;
            $hdap->intro = $request->intro;
            $hdap->order = $request->order;
            $hdap->status = $request->status;
            $hdap->save();
            return redirect()->route('admin.hoidap.chitiet', ['id'=>$id])->with('success', 'Cập nhật thông tin hỏi đáp thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.hoidap.chitiet', ['id'=>$id])->with('error', 'Lỗi, cập nhật thông tin hỏi đáp thất bại!');
        }
    }

    /**
     * @function delete hoidap
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function hoiDapDelete($id) {
        try {
            $hdap = hoidap::find($id);
            $hdap->delete();
            return redirect()->route('admin.hoidap')->with('success', 'xóa hỏi đáp thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.hoidap')->with('error', 'Lỗi, xóa hỏi đáp thất bại!');
        }
    }
}
