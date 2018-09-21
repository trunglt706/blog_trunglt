<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResearchRequest;
use App\researchs;
use Illuminate\Support\Facades\Log;
use Exception;

class ResearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @function insert new research
     * @param ResearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function insert(ResearchRequest $request) {
        try {
            $find = new researchs();
            $find->keyword = $request->keyword;
            $phoi->count = $request->count;
            $find->save();
            return view('admin.research.list')->with('success', 'Thêm mới từ khóa tìm kiếm thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('admin.research.list')->with('error', 'Lỗi, thêm mới từ khóa tìm kiếm thất bại!');
        }
    }

    /**
     * @function update info research
     * @param ResearchRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(ResearchRequest $request, $id) {
        try {
            $find = researchs::findOrFail($id);
            $find->keyword = $request->keyword;
            $phoi->count = $request->count;
            $find->save();
            return view('admin.research.detail', ['id' => $id])->with('success', 'Cập nhật thông tin từ khóa tìm kiếm thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('admin.research.detail', ['id' => $id])->with('error', 'Lỗi, cập nhật thông tin từ khóa tìm kiếm thất bại!');
        }
    }

    /**
     * @function delete research
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id) {
        try {
            $find = researchs::findOrFail($id);
            $find->delete();
            return view('admin.research.list')->with('success', 'Xóa từ khóa tìm kiếm thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('admin.research.list')->with('error', 'Lỗi, xóa từ khóa tìm kiếm thất bại!');
        }
    }
}
