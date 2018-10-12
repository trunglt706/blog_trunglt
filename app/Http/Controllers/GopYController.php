<?php

namespace App\Http\Controllers;

use App\Http\Requests\GopYRequest;
use App\gopys;
use Exception;
use Illuminate\Support\Facades\Log;

class GopYController extends Controller {

    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * @function go to list gopy
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gopY() {
        $object['listgopy'] = gopys::paginate(10);
        return view('admin.gopy.list', ['object' => $object]);
    }

    /**
     * @function go to detail gopy
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gopYChiTiet($id) {
        $object['gopy'] = gopys::findOrFail($id);
        return view('admin.gopy.detail', ['object' => $object]);
    }

    /**
     * @function insert gop y
     * @param GopYRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function gopYInsert(GopYRequest $request) {
        try {
            $gopy = new gopys();
            $gopy->email = $request->email;
            $gopy->content = $request->input('content');
            $gopy->save();
            \Slack::send('[Feedback Insert] - Success: '.auth()->user()->email);
            return redirect()->route('admin.gopy')->with('success', 'Thêm mới góp ý thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            \Slack::send('[Feedback Insert] - '.$e->getMessage());
            return redirect()->route('admin.gopy')->with('error', 'Lỗi, thêm mới góp ý thất bại!');
        }
    }

    /**
     * @function update gop y
     * @param GopYUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function gopYUpdate(GopYRequest $request, $id) {
        try {
            $gopy = gopys::find($id);
            $gopy->email = $request->email;
            $gopy->content = $request->input('content');
            $gopy->save();
            \Slack::send('[Feedback Update] - Success: '.auth()->user()->email);
            return redirect()->route('admin.gopy.chitiet', ['id' => $id])->with('success', 'Cập nhật thông tin góp ý thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            \Slack::send('[Feedback Update] - '.$e->getMessage());
            return redirect()->route('admin.gopy.chitiet', ['id' => $id])->with('error', 'Lỗi, cập nhật thông tin góp ý thất bại!');
        }
    }

    /**
     * @function delete gop y
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function gopYDelete($id) {
        try {
            $gopy = gopys::find($id);
            $gopy->delete();
            \Slack::send('[Feedback Delete] - Success: '.auth()->user()->email);
            return redirect()->route('admin.gopy')->with('success', 'xóa góp ý thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            \Slack::send('[Feedback Delete] - '.$e->getMessage());
            return redirect()->route('admin.gopy')->with('error', 'Lỗi, xóa góp ý thất bại!');
        }
    }

}
