<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhanHoiRequest;
use App\phanhois;
use Illuminate\Support\Facades\Log;
use Exception;

class PhanHoiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
     * @function go to list phan hoi
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function phanHoi() {
        $object['phanhoi'] = phanhois::paginate(10);
        return view('admin.phanhoi.list', ['object' => $object]);
    }

    /**
     * @function go to detail phan hoi
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function phanHoiChiTiet($id) {
        $object['phoi'] = phanhois::findOrFail($id);
        return view('admin.phanhoi.detail', ['object' => $object]);
    }

    /**
     * @function insert new phan hoi
     * @param PhanHoiRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function insert(PhanHoiRequest $request) {
        try {
            $phoi = new phanhois();
            $phoi->id_baiviet = $request->id_baiviet;
            $phoi->email = $request->email;
            $phoi->content = $request->content;
            $phoi->save();
            return view('admin.phanhoi.list')->with('success', 'Thêm mới thông tin phản hồi thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('admin.phanhoi.list')->with('error', 'Lỗi, thêm mới thông tin phản hồi thất bại!');
        }
    }

    /**
     * @function update info phan hoi
     * @param PhanHoiRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(PhanHoiRequest $request, $id) {
        try {
            $phoi = phanhois::findOrFail($id);
            $phoi->id_baiviet = $request->id_baiviet;
            $phoi->email = $request->email;
            $phoi->content = $request->content;
            $phoi->save();
            return view('admin.phanhoi.detail', ['id' => $id])->with('success', 'Cập nhật thông tin phản hồi thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('admin.phanhoi.detail', ['id' => $id])->with('error', 'Lỗi, cập nhật thông tin phản hồi thất bại!');
        }
    }

    /**
     * @function delete info phan hoi
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id) {
        try {
            $phoi = phanhois::findOrFail($id);
            $phoi->delete();
            return view('admin.phanhoi.list')->with('success', 'Xóa thông tin phản hồi thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('admin.phanhoi.list')->with('error', 'Lỗi, xóa thông tin phản hồi thất bại!');
        }
    }
}
