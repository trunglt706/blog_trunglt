<?php

namespace App\Http\Controllers;

use App\Http\Requests\CauHinhChungRequest;
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
     * @function go to list cauhinhchung
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cauHinhChung() {
        $object['list_cauhinh'] = cauhinhchungs::paginate(10);
        return view('admin.cauhinhchung.list', ['object' => $object]);
    }

    /**
     * @function go to detail cauhinhchung
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cauHinhChungChiTiet($id) {
        $object['chinh'] = cauhinhchungs::findOrFail($id);
        return view('admin.cauhinhchung.detail', ['object' => $object]);
    }

    /**
     * @function insert cau hinh chung
     * @param CauHinhChungRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cauHinhChungInsert(CauHinhChungRequest $request) {
        try {
            $chinh = new cauhinhchungs();
            $chinh->name = $request->name;
            $chinh->slug = $request->slug;
            $chinh->intro = $request->intro;
            $chinh->value = $request->value;
            $chinh->save();
            return redirect()->route('admin.cauhinhchung')->with('success', 'Thêm mới cấu hình chung thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.cauhinhchung')->with('error', 'Lỗi, thêm mới cấu hình chung thất bại!');
        }
    }

    /**
     * @function update cau hinh chung
     * @param CauHinhChungUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cauHinhChungUpdate(CauHinhChungUpdateRequest $request, $id) {
        try {
            $chinh = cauhinhchungs::find($id);
            $chinh->name = $request->name;
            $chinh->slug = $request->slug;
            $chinh->intro = $request->intro;
            $chinh->value = $request->value;
            $chinh->save();
            return redirect()->route('admin.cauhinhchung.chitiet', ['id' => $id])->with('success', 'Cập nhật thông tin cấu hình chung thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.cauhinhchung.chitiet', ['id' => $id])->with('error', 'Lỗi, câp nhật thôn tin cấu hình chung thất bại!');
        }
    }

    /**
     * @function delete cau hinh chung
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cauHinhChungDelete($id) {
        try {
            $chinh = cauhinhchungs::find($id);
            File::delete($chinh->value);
            $chinh->delete();
            return redirect()->route('admin.cauhinhchung')->with('success', 'Xóa cấu hình thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.cauhinhchung')->with('error', 'Lỗi, xóa cấu hình thất bại!');
        }
    }
}
