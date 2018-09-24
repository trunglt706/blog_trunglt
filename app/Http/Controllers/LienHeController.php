<?php

namespace App\Http\Controllers;
use App\Http\Requests\LienHeRequest;
use App\lienhe;
use Exception;
use Illuminate\Support\Facades\Log;

class LienHeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @function go to list lienhe
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lienHe() {
        $data = lienhe::all();
        return view('admin.lienhe.list', compact('data'));
    }

    /**
     * @function go to detail lienhe
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lienHeChiTiet($id) {
        $data = lienhe::findOrFail($id);
        return view('admin.lienhe.detail', compact('data'));
    }

    /**
     * @function insert lienhe
     * @param GopYRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lienHeInsert(LienHeRequest $request) {
        try {
            $lhe = new lienhe();
            $lhe->name = $request->name;
            $lhe->email = $request->email;
            $lhe->content = $request->input('content');
            $lhe->status = $request->status;
            $lhe->save();
            return redirect()->route('admin.lienhe')->with('success', 'Thêm mới liên hệ thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.lienhe')->with('error', 'Lỗi, thêm mới liên hệ thất bại!');
        }
    }

    /**
     * @function update lienhe
     * @param GopYUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lienHeUpdate(LienHeRequest $request, $id) {
        try {
            $lhe = lienhe::find($id);
            $lhe->name = $request->name;
            $lhe->email = $request->email;
            $lhe->content = $request->input('content');
            $lhe->status = $request->status;
            $lhe->save();
            return redirect()->route('admin.lienhe.chitiet', ['id'=>$id])->with('success', 'Cập nhật thông tin liên hệ thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.lienhe.chitiet', ['id'=>$id])->with('error', 'Lỗi, cập nhật thông tin liên hệ thất bại!');
        }
    }

    /**
     * @function delete lienhe
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lienHeDelete($id) {
        try {
            $lhe = lienhe::find($id);
            $lhe->delete();
            return redirect()->route('admin.lienhe')->with('success', 'xóa liên hệ thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.lienhe')->with('error', 'Lỗi, xóa liên hệ thất bại!');
        }
    }
}
