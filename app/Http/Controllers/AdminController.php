<?php

namespace App\Http\Controllers;

use App\Http\Requests\BaiVietRequest;
use App\Http\Requests\BaiVietUpdateRequest;
use App\Http\Requests\CauHinhChungRequest;
use App\Http\Requests\CauHinhChungUpdateRequest;
use App\Http\Requests\DanhMucBaiVietRequest;
use App\Http\Requests\DanhMucUpdateRequest;
use App\Http\Requests\GopYRequest;
use App\Http\Requests\GopYUpdateRequest;
use App\Http\Requests\LoaiThanhVienRequest;
use App\Http\Requests\LoaiThanhVienUpdateRequest;
use App\Http\Requests\NhanBaiVietRequest;
use App\Http\Requests\NhanBaiVietUpdateRequest;
use App\Http\Requests\ResearchRequest;
use App\Http\Requests\ResearchUpdateRequest;
use App\Http\Requests\UpdateAccountAdminRequest;
use App\Http\Requests\UpdateAccountUserRequest;
use App\Http\Requests\UpdateInfoAdminRequest;
use App\Http\Requests\UpdateInforUserRequest;
use App\Http\Requests\UserRequest;
use App\admins;
use App\baiviets;
use App\cauhinhchungs;
use App\danhmucbaiviets;
use App\gopys;
use App\loaithanhviens;
use App\nhanbaiviets;
use App\researchs;
use App\users;
use Image;
use File;
use Auth;
use Hash;
use Illuminate\Support\Facades\Log;
use Exception;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * @function go to index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('admin.home');
    }

    /**
     * @function logout
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {
        try {
            $admin = admins::find(auth()->user()->id);
            $admin->status = 0;
            $admin->save();
            Auth::guard('admin')->logout();
            return redirect()->route('login')->with('success', 'Đăng xuất hệ thống thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.index')->with('error', 'Lỗi, hệ thống không lấy được dữ liệu! Vui lòng thử lại.');
        }
    }

    //======================================================= Profile
    /**
     * @function go to account page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile() {
        return view('admin.profile');
    }

    /**
     * @function update info admin
     * @param UpdateInfoAdminRequest $request
     * @return mixed
     */
    public function inforUpdate(UpdateInfoAdminRequest $request) {
        try {
            $ad = admins::find(auth()->user()->id);
            $ad->name = $request->name;
            $ad->intro = $request->intro;
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($avatar)->save(base_path($path));
                $ad->avatar = '/' . $path;
            }
            if ($request->hasFile('background')) {
                $bg = $request->file('background');
                $filename = time() . '.' . $bg->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($bg)->save(base_path($path));
                $ad->background = '/' . $path;
            }
            $ad->save();
            return route('admin.info')->with('success', 'Cập nhật thông tin admin thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return route('admin.info')->with('error', 'Lỗi, cập nhật thông tin admin thất bại!');
        }
    }

    /**
     * @function update account admin
     * @param UpdateAccountAdminRequest $request
     * @return mixed
     */
    public function accountUpdate(UpdateAccountAdminRequest $request) {
        try {
            $ad = admins::find(auth()->user()->id);
            $ad->email = $request->email;
            $ad->password = bcrypt($request->password);
            $ad->save();
            return route('admin.info')->with('success', 'Cập nhật tài khoản admin thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return route('admin.info')->with('error', 'Lỗi, cập nhật tài khoản admin thất bại!');
        }
    }

    //======================================================= Bai viet
    /**
     * @function go to list baiviet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function baiViet() {
        $data = baiviets::all();
        return view('admin.baiviet.list', compact('data'));
    }

    /**
     * @function go to detail baiviet
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function baiVietChiTiet($id) {
        $data = baiviets::findOrFail($id);
        return view('admin.baiviet.detail', compact('data'));
    }

    /**
     * @function delete bai viet
     * @param BaiVietRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function baiVietInsert(BaiVietRequest $request) {
        try {
            $bviet = new baiviets();
            $bviet->id_danhmuc = $request->id_danhmuc;
            $bviet->username = auth()->user()->id;
            $bviet->name = $request->name;
            $bviet->slug = str_slug($request->name, '-');
            $bviet->intro = $request->intro;
            $bviet->content = $request['content'];
            $bviet->keyword = $request->keyword;
            $bviet->important = isset($request->important) ? 1 : 0;
            $bviet->rating = $request->rating;
            $bviet->status = $request->status;
            if ($request->hasFile('thumn')) {
                $thumn = $request->file('thumn');
                $filename = time() . '.' . $thumn->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($thumn)->save(base_path($path));
                $bviet->thumn = '/' . $path;
            }
            if ($request->hasFile('background')) {
                $background = $request->file('background');
                $filename = time() . '.' . $background->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($background)->save(base_path($path));
                $bviet->background = '/' . $path;
            }
            $bviet->save();
            return redirect()->route('admin.baiviet')->with('success', 'Thêm bài viết mới thành công.');
        } catch(Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.baiviet')->with('error', 'Lỗi, thêm bài viết mới thất bại!');
        }
    }

    /**
     * @function update bai viet
     * @param BaiVietUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function baiVietUpdate(BaiVietUpdateRequest $request, $id) {
        try {
            $bviet = baiviets::find($id);
            $bviet->id_danhmuc = $request->id_danhmuc;
            $bviet->name = $request->name;
            $bviet->intro = $request->intro;
            $bviet->content = $request['content'];
            $bviet->keyword = $request->keyword;
            $bviet->important = isset($request->important) ? 1 : 0;
            $bviet->rating = $request->rating;
            $bviet->status = $request->status;
            if ($request->hasFile('thumn')) {
                $thumn = $request->file('thumn');
                $filename = time() . '.' . $thumn->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($thumn)->save(base_path($path));
                $bviet->thumn = '/' . $path;
            }
            if ($request->hasFile('background')) {
                $background = $request->file('background');
                $filename = time() . '.' . $background->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($background)->save(base_path($path));
                $bviet->background = '/' . $path;
            }
            $bviet->save();
            return redirect()->route('admin.baiviet.chitiet', ['id' => $id])->with('success', 'Cập nhật thông tin bài viết thành công.');
        } catch(Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.baiviet.chitiet', ['id' => $id])->with('error', 'Lỗi, cập nhật thông tin bài viết thất bại!');
        }
    }

    /**
     * @function xoa bai viet
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function baiVietDelete($id) {
        try {
            $bviet = baiviets::find($id);
            File::delete($bviet->thumn);
            File::delete($bviet->thumn);
            $bviet->delete();
            return redirect()->route('admin.baiviet')->with('success', 'Xóa bài viết thất bại!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.baiviet')->with('error', 'Lỗi, xóa bài viết thất bại!');
        }
    }

    //======================================================= cau hinh chung
    /**
     * @function go to list cauhinhchung
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cauHinhChung() {
        $data = cauhinhchungs::all();
        return view('admin.cauhinhchung.list', compact('data'));
    }

    /**
     * @function go to detail cauhinhchung
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cauHinhChungChiTiet($id) {
        $data = cauhinhchungs::findOrFail($id);
        return view('admin.cauhinhchung.detail', compact('data'));
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

    //======================================================= danh muc
    /**
     * @function go to list danhmuc baiviet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function danhMuc() {
        $data = danhmucbaiviets::all();
        return view('admin.danhmuc-baiviet.list', compact('data'));
    }

    /**
     * @function go to detail danhmuc baiviet
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function danhMucChiTiet($id) {
        $data = danhmucbaiviets::findOrFail($id);
        return view('admin.danhmuc-baiviet.detail', compact('data'));
    }

    /**
     * @function insert danh muc bai viet
     * @param DanhMucBaiVietRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function danhMucInsert(DanhMucBaiVietRequest $request) {
        try {
            $dmuc = new danhmucbaiviets();
            $dmuc->name = $request->name;
            $dmuc->slug = $request->slug;
            $dmuc->intro = $request->intro;
            $dmuc->status = $request->status;
            $dmuc->save();
            return redirect()->route('admin.danhmuc')->with('success', 'Thêm mới danh mục bài viết thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.danhmuc')->with('error', 'Lỗi, thêm mới danh mục bài viết thất bại!');
        }
    }

    /**
     * @function update danh muc bai viet
     * @param DanhMucUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function danhMucUpdate(DanhMucUpdateRequest $request, $id) {
        try {
            $dmuc = danhmucbaiviets::find($id);
            $dmuc->name = $request->name;
            $dmuc->slug = $request->slug;
            $dmuc->intro = $request->intro;
            $dmuc->status = $request->status;
            $dmuc->save();
            return redirect()->route('admin.danhmuc.chitiet', ['id' => $id])->with('success', 'cập nhật thông tin danh mục bài viết thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.danhmuc.chitiet', ['id' => $id])->with('error', 'Lỗi, cập nhật thông tin danh mục bài viết thất bại!');
        }
    }

    /**
     * @function delete danh muc bai viet
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function danhMucDelete($id) {
        try {
            $dmuc = danhmucbaiviets::find($id);
            $dmuc->delete();
            return redirect()->route('admin.danhmuc')->with('success', 'xóa danh mục bài viết thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.danhmuc')->with('error', 'Lỗi, xóa danh mục bài viết thất bại!');
        }
    }

    //======================================================= gop y
    /**
     * @function go to list gopy
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gopY() {
        $data = gopys::all();
        return view('admin.gopy.list', compact('data'));
    }

    /**
     * @function go to detail gopy
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gopYChiTiet($id) {
        $data = gopys::findOrFail($id);
        return view('admin.gopy.detail', compact('data'));
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
            return redirect()->route('admin.gopy')->with('success', 'Thêm mới góp ý thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.gopy')->with('error', 'Lỗi, thêm mới góp ý thất bại!');
        }
    }

    /**
     * @function update gop y
     * @param GopYUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function gopYUpdate(GopYUpdateRequest $request, $id) {
        try {
            $gopy = gopys::find($id);
            $gopy->email = $request->email;
            $gopy->content = $request->input('content');
            $gopy->save();
            return redirect()->route('admin.gopy.chitiet', ['id'=>$id])->with('success', 'Cập nhật thông tin góp ý thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.gopy.chitiet', ['id'=>$id])->with('error', 'Lỗi, cập nhật thông tin góp ý thất bại!');
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
            return redirect()->route('admin.gopy')->with('success', 'xóa góp ý thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.gopy')->with('error', 'Lỗi, xóa góp ý thất bại!');
        }
    }

    //======================================================= Loai thanh vien
    /**
     * @function go to list loai thanhvien
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loaiThanhVien() {
        $data = loaithanhviens::all();
        return view('admin.loai-thanhvien.list', compact('data'));
    }

    /**
     * @function go to detail loai thanhvien
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loaiThanhVienChiTiet($id) {
        $data = loaithanhviens::findOrFail($id);
        return view('admin.loai-thanhvien.detail', compact('data'));
    }

    /**
     * @function insert loai thanh vien
     * @param LoaiThanhVienRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loaiThanhVienInsert(LoaiThanhVienRequest $request) {
        try {
            $loaitv = new loaithanhviens();
            $loaitv->name = $request->email;
            $loaitv->slug = $request->slug;
            $loaitv->intro = $request->intro;
            $loaitv->mark = $request->mark;
            $loaitv->status = $request->status;
            if ($request->hasFile('logo')) {
                $loai = $request->file('logo');
                $filename = time() . '.' . $loai->getClientOriginalExtension();
                $dir = 'uploads/loaithanhviens/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($loai)->save(base_path($path));
                $loaitv->logo = '/' . $path;
            }
            $loaitv->save();
            return redirect()->route('admin.loaithanhvien')->with('success', 'Thêm mới loại thành viên thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.loaithanhvien')->with('error', 'Lỗi, thêm mới loại thành viên thất bại!');
        }
    }

    /**
     * @function update loai thah vien
     * @param LoaiThanhVienUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loaiThanhVienUpdate(LoaiThanhVienUpdateRequest $request, $id) {
        try {
            $loaitv = loaithanhviens::find($id);
            $loaitv->name = $request->email;
            $loaitv->slug = $request->slug;
            $loaitv->intro = $request->intro;
            $loaitv->mark = $request->mark;
            $loaitv->status = $request->status;
            if ($request->hasFile('logo')) {
                $loai = $request->file('logo');
                $filename = time() . '.' . $loai->getClientOriginalExtension();
                $dir = 'uploads/loaithanhviens/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($loai)->save(base_path($path));
                $loaitv->logo = '/' . $path;
            }
            $loaitv->save();
            return redirect()->route('admin.loaithanhvien.chitiet', ['id'=>$id])->with('success', 'Cập nhật loại thành viên thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.loaithanhvien.chitiet', ['id'=>$id])->with('error', 'Lỗi, cập nhật loại thành viên thất bại!');
        }
    }

    /**
     * @function delete loai thanh vien
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loaiThanhVienDelete($id) {
        try {
            $loaitv = loaithanhviens::find($id);
            $loaitv->delete();
            return redirect()->route('admin.loaithanhvien')->with('success', 'xóa loại thành viên thành công.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.loaithanhvien')->with('error', 'Lỗi, xóa loại thành viên thất bại!');
        }
    }

    //======================================================= nhan bai viet
    /**
     * @function go to list nhan baiviet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function nhanBaiViet() {
        $data = nhanbaiviets::all();
        return view('admin.nhan-baiviet.list', compact('data'));
    }

    /**
     * @function go to detail nhan baiviet
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function nhanBaiVietChiTiet($id) {
        $data = nhanbaiviets::findOrFail($id);
        return view('admin.nhan-baiviet.detail', compact('data'));
    }

    /**
     * @functio insert nhan bai viet
     * @param NhanBaiVietRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function nhanBaiVietInsert(NhanBaiVietRequest $request) {
        try {
            $nhanbv = new nhanbaiviets();
            $nhanbv->email = $request->email;
            $nhanbv->status = $request->status;
            $nhanbv->save();
            return redirect()->route('admin.nhanbaiviet')->with('success', 'Thêm mới thông tin nhận bài viết thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.nhanbaiviet')->with('error', 'Lỗi, thêm mới thông tin nhận bài viết thất bại!');
        }
    }

    /**
     * @function update nhan bai viet
     * @param NhanBaiVietUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function nhanBaiVietUpdate(NhanBaiVietUpdateRequest $request, $id) {
        try {
            $nhanbv = nhanbaiviets::find($id);
            $nhanbv->email = $request->email;
            $nhanbv->status = $request->status;
            $nhanbv->save();
            return redirect()->route('admin.nhanbaiviet.chitiet', ['id'=>$id])->with('success', 'Cập nhật thông tin nhận bài viết thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.nhanbaiviet.chitiet', ['id'=>$id])->with('error', 'Lỗi, cập nhật thông tin nhận bài viết thất bại!');
        }
    }

    /**
     * @function delete nhan bai viet
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function nhanBaiVietDelete($id) {
        try {
            $nhanbv = nhanbaiviets::find($id);
            $nhanbv->delete();
            return redirect()->route('admin.nhanbaiviet')->with('success', 'xóa nhận bài viết thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.nhanbaiviet')->with('error', 'Lỗi, xóa nhận bài viết thất bại!');
        }
    }

    //======================================================= research
    /**
     * @function go to list research
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function research() {
        $data = researchs::all();
        return view('admin.research.list', compact('data'));
    }

    /**
     * @function go to detail research
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function researchChiTiet($id) {
        $data = researchs::findOrFail($id);
        return view('admin.research.detail', compact('data'));
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

    //======================================================= thanh vien
    /**
     * @function go to list user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function thanhVien() {
        $data = users::all();
        return view('admin.user.list', compact('data'));
    }

    /**
     * @function go to detail user
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function thanhVienChiTiet($id) {
        $data = users::findOrFail($id);
        return view('admin.user.detail', compact('data'));
    }

    /**
     * @function update info user
     * @param UpdateInforUserRequest $request
     * @return mixed
     */
    public function thanhVienUpdateInfo(UpdateInforUserRequest $request, $id) {
        try {
            $u = users::findOrFail($id);
            $u->name = $request->name;
            $u->intro = $request->intro;
            $u->id_loaithanhvien = $request->id_loaithanhvien;
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($avatar)->save(base_path($path));
                $u->avatar = '/' . $path;
            }
            if ($request->hasFile('background')) {
                $bg = $request->file('background');
                $filename = time() . '.' . $bg->getClientOriginalExtension();
                $dir = 'uploads/baiviets/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($bg)->save(base_path($path));
                $u->background = '/' . $path;
            }
            $u->save();
            return route('admin.user.detail', ['id' => $id])->with('success', 'Cập nhật thông tin người dùng thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return route('admin.user.detail', ['id' => $id])->with('error', 'Lỗi, cập nhật thông tin người dùng thất bại!');
        }
    }

    /**
     * @function update account user
     * @param UpdateAccountUserRequest $request
     * @return mixed
     */
    public function thanhVienUpdateAccount(UpdateAccountUserRequest $request, $id) {
        try {
            $ad = users::findOrFail($id);
            $ad->email = $request->email;
            $ad->password = bcrypt($request->password);
            $ad->save();
            return route('admin.user.detail', ['id' => $id])->with('success', 'Cập nhật tài khoản người dùng thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return route('admin.user.detail', ['id' => $id])->with('error', 'Lỗi, cập nhật tài khoản người dùng thất bại!');
        }
    }

    /**
     * @function insert new user
     * @param UserRequest $request
     * @return mixed
     */
    public function thanhVienInsert(UserRequest $request) {
        try {
            $u = new users();
            $u->username = substr(md5(microtime()), rand(0, 15), 15);
            $u->name = $request->name;
            $u->intro = $request->intro;
            $u->id_loaithanhvien = $request->id_loaithanhvien;
            $u->email = $request->email;
            $u->password = bcrypt($request->password);
            $u->status = $request->status;
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                $dir = 'uploads/users/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($avatar)->save(base_path($path));
                $u->avatar = '/' . $path;
            }
            if ($request->hasFile('background')) {
                $bg = $request->file('background');
                $filename = time() . '.' . $bg->getClientOriginalExtension();
                $dir = 'uploads/users/';
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0777, true, true);
                }
                $path = $dir . $filename;
                Image::make($bg)->save(base_path($path));
                $u->background = '/' . $path;
            }
            $u->save();
            return route('admin.user.list')->with('success', 'Thêm mới người dùng thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return route('admin.user.list')->with('error', 'Lỗi, thêm mới người dùng thất bại!');
        }
    }

    /**
     * @function delete user
     * @param $id
     * @return mixed
     */
    public function thanhVienDelete($id) {
        try {
            $u = users::findOrFail($id);
            //Delete all baiviet cua user
            $list_bv = baiviets::where('username', $u->username)->get();
            if(!is_null($list_bv)) {
                foreach ($list_bv as $l) {
                    $b = baiviets::findOrFail($l->id);
                    File::delete($b->thumn);
                    File::delete($b->background);
                    $b->delete();
                }
            }
            //delete user
            File::delete($u->avatar);
            File::delete($u->background);
            $u->delete();
            return route('admin.user.list')->with('success', 'Xóa người dùng thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return route('admin.user.list')->with('error', 'Lỗi, xóa người dùng thất bại!');
        }
    }

    /**
     * @function block account user
     */
    public function thanhVienBlock($id) {
        //block account user
        $u = users::findOrFail($id);
        $u->status = -1;
        $u->save();

        //block all baiviet cua user
        $count = 0;
        $list = baiviets::where('username', $u->username)->get();
        if(!is_null($list)) {
            foreach ($list as $l) {
                $b = baiviets::findOrFail($l->id);
                if($b->status != -1) {
                    $b->status = -1;
                    $b->save();
                    $count++;
                }
            }
        }
        echo array('status' => 'success', 'ms' => 'Block tài khoản '.$u->email.' thành công. Có '.$count.'/'.count($list).' bài viết đã khóa kèm theo!');
    }
}
