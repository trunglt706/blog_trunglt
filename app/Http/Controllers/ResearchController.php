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
     * @function go to list research
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function research() {
        $object['researchs'] = researchs::all();
        return view('admin.research.list', ['object' => $object]);
    }

    /**
     * @function go to detail research
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function researchChiTiet($id) {
        $object['research'] = researchs::findOrFail($id);
        return view('admin.research.detail', ['object' => $object]);
    }

    /**
     * @function insert research
     * @param ResearchRequest $request
     * @return \Illuminate\Http\RedirectResponse'
     */
    public function researchInsert(ResearchRequest $request) {
        try {
            $rs = new researchs();
            $rs->email = $request->email;
            $rs->keyword = $request->keyword;
            $rs->count = $request->count;
            $rs->save();
            return redirect()->route('admin.research')->with('success', 'Thêm mới thông tin tìm kiếm thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.research')->with('error', 'Lỗi, thêm mới thông tin tìm kiếm thất bại!');
        }
    }

    /**
     * @function update research
     * @param ResearchUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function researchUpdate(ResearchUpdateRequest $request, $id) {
        try {
            $rs = researchs::find($id);
            $rs->email = $request->email;
            $rs->keyword = $request->keyword;
            $rs->count = $request->count;
            $rs->save();
            return redirect()->route('admin.research.chitiet', ['id'=>$id])->with('success', 'Cập nhật thông tin tìm kiếm thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.research.chitiet', ['id'=>$id])->with('error', 'Lỗi, cập nhật thông tin tìm kiếm thất bại!');
        }
    }

    /**
     * @function delete research
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function researchDelete($id) {
        try {
            $rs = researchs::find($id);
            $rs->delete();
            return redirect()->route('admin.research')->with('success', 'xóa thông tin tìm kiếm thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.research')->with('error', 'Lỗi, xóa thông tin tìm kiếm thất bại!');
        }
    }
}
