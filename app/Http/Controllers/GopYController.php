<?php

namespace App\Http\Controllers;

use App\Http\Requests\GopYRequest;
use App\gopys;
use Exception;
use Illuminate\Support\Facades\Log;

class GopYController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * @function insert new gopy
     * @param GopYRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function insert(GopYRequest $request) {
        try {
            $gy = new gopys();
            $gy->email = $request->email;
            $gy->content = $request->content;
            $gy->save();
            return view('admin.gopy.list')->with('success', 'Thêm mới góp ý thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('admin.gopy.list')->with('error', 'Lỗi, thêm mới góp ý thất bại!');
        }
    }

    /**
     * @function update info gopy
     * @param GopYRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(GopYRequest $request, $id) {
        try {
            $gy = gopys::findOrFail($id);
            $gy->email = $request->email;
            $gy->content = $request->content;
            $gy->save();
            return view('admin.gopy.detail', ['id' => $id])->with('success', 'Cập nhật thông tin góp ý thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('admin.gopy.detail', ['id' => $id])->with('error', 'Lỗi, cập nhật thông tin góp ý thất bại!');
        }
    }

    /**
     * @function delete gopy
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id) {
        try {
            $gy = gopys::findOrFail($id);
            $gy->delete();
            return view('admin.gopy.list')->with('success', 'Xóa góp ý thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('admin.gopy.list')->with('error', 'Lỗi, xóa góp ý thất bại!');
        }
    }
}
