<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//============================== Router for auth
Route::get('/', 'HomeController@index')->name('home');
Route::get('/lien-he', 'HomeController@contact')->name('contact');
Route::get('/hoi-dap', 'HomeController@hoidap')->name('hoidap');
Route::get('/danh-muc-bai-viet/{slug}', 'HomeController@danhmuc_baiviet')->name('danhmuc.baiviet');
Route::get('/bai-viet/{slug}', 'HomeController@baiviet')->name('detail.baiviet');
Route::post('/bai-viet/like', 'HomeController@baivietLike')->name('baiviet.like');
Route::get('/gioi-thieu', 'HomeController@introduce')->name('introduce');
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/tac-gia/{id}', 'HomeController@getAuthor')->name('tacgia.index');
Route::get('/tac-gia', 'HomeController@listAuthor')->name('tacgia.list');

Route::post('/login-admin', 'Auth\LoginController@loginAdmin')->name('login-admin');
Route::post('/phanhoi', 'HomeController@postPhanHoi')->name('phanhoi.post');
Route::post('/lienhe', 'HomeController@postLienHe')->name('lienhe.post');

Route::prefix('ajax')->group(function () {
    Route::get('/search', 'HomeController@searchAjax')->name('ajax.search');
});

//============================== Router for user
Route::prefix('user')->group(function () {
    Route::get('/', 'UserController@index')->name('user.index');

    Route::get('bai-viet', 'UserController@baiViet')->name('user.baiviet');
    Route::get('bai-viet/{id}', 'UserController@baiVietChiTiet')->name('user.baiviet.chitiet');

    Route::get('logout', 'UserController@logout')->name('user.logout');
});

//============================== Router for admin
Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('logout', 'AdminController@logout')->name('admin.logout');

    Route::get('profile', 'AdminController@profile')->name('admin.profile');
    Route::post('profile/info', 'AdminController@inforUpdate')->name('admin.info.update');
    Route::post('profile/account', 'AdminController@accountUpdate')->name('admin.account.update');

    Route::get('loai-thanh-vien', 'LoaiThanhVienController@loaiThanhVien')->name('admin.loaithanhvien');
    Route::get('loai-thanh-vien/{id}', 'LoaiThanhVienController@loaiThanhVienChiTiet')->name('admin.loaithanhvien.chitiet');
    Route::post('loai-thanh-vien/insert', 'LoaiThanhVienController@loaiThanhVienInsert')->name('admin.loaithanhvien.insert');
    Route::post('loai-thanh-vien/update/{id}', 'LoaiThanhVienController@loaiThanhVienUpdate')->name('admin.loaithanhvien.update');
    Route::get('loai-thanh-vien/delete/{id}', 'LoaiThanhVienController@loaiThanhVienDelete')->name('admin.loaithanhvien.delete');

    Route::get('lien-he', 'LienHeController@lienHe')->name('admin.lienhe');
    Route::get('lien-he/{id}', 'LienHeController@lienHeChiTiet')->name('admin.lienhe.chitiet');
    Route::post('lien-he/insert', 'LienHeController@lienHeInsert')->name('admin.lienhe.insert');
    Route::post('lien-he/update/{id}', 'LienHeController@lienHeUpdate')->name('admin.lienhe.update');
    Route::get('lien-he/delete', 'LienHeController@lienHeDelete')->name('admin.lienhe.delete');

    Route::get('danh-muc', 'DanhMucBaiVietController@danhMuc')->name('admin.danhmuc');
    Route::get('danh-muc/{id}', 'DanhMucBaiVietController@danhMucChiTiet')->name('admin.danhmuc.chitiet');
    Route::post('danh-muc/insert', 'DanhMucBaiVietController@danhMucInsert')->name('admin.danhmuc.insert');
    Route::post('danh-muc/update/{id}', 'DanhMucBaiVietController@danhMucUpdate')->name('admin.danhmuc.update');
    Route::get('danh-muc/delete/{id}', 'DanhMucBaiVietController@danhMucDelete')->name('admin.danhmuc.delete');

    Route::get('bai-viet', 'BaiVietController@baiViet')->name('admin.baiviet');
    Route::get('bai-viet/{id}', 'BaiVietController@baiVietChiTiet')->name('admin.baiviet.chitiet');
    Route::post('bai-viet/insert', 'BaiVietController@baiVietInsert')->name('admin.baiviet.insert');
    Route::post('bai-viet/update/{id}', 'BaiVietController@baiVietUpdate')->name('admin.baiviet.update');
    Route::get('bai-viet/delete/{id}', 'BaiVietController@baiVietDelete')->name('admin.baiviet.delete');

    Route::get('thanh-vien', 'ThanhVienController@thanhVien')->name('admin.thanhvien');
    Route::get('thanh-vien/{id}', 'ThanhVienController@thanhVienChiTiet')->name('admin.thanhvien.chitiet');
    Route::post('thanh-vien/insert', 'ThanhVienController@thanhVienInsert')->name('admin.thanhvien.insert');
    Route::post('thanh-vien/update/info/{id}', 'ThanhVienController@thanhVienUpdateInfo')->name('admin.thanhvien.update.info');
    Route::post('thanh-vien/update/account/{id}', 'ThanhVienController@thanhVienUpdateAccount')->name('admin.thanhvien.update.account');
    Route::get('thanh-vien/delete/{id}', 'ThanhVienController@thanhVienDelete')->name('admin.thanhvien.delete');
    Route::post('thanh-vien/block/{id}', 'ThanhVienController@thanhVienBlock')->name('admin.thanhvien.block');

    Route::get('quang-cao', 'QuangCaoController@quangCao')->name('admin.quangcao');
    Route::get('quang-cao/{id}', 'QuangCaoController@quangCaoChiTiet')->name('admin.quangcao.chitiet');
    Route::post('quang-cao/insert', 'QuangCaoController@quangCaoInsert')->name('admin.quangcao.insert');
    Route::post('quang-cao/update/{id}', 'QuangCaoController@quangCaoUpdate')->name('admin.quangcao.update');
    Route::get('quang-cao/delete/{id}', 'QuangCaoController@quangCaoDelete')->name('admin.quangcao.delete');

    Route::get('gop-y', 'GopYController@gopY')->name('admin.gopy');
    Route::get('gop-y/{id}', 'GopYController@gopYChiTiet')->name('admin.gopy.chitiet');
    Route::post('gop-y/insert', 'GopYController@gopYInsert')->name('admin.gopy.insert');
    Route::post('gop-y/update/{id}', 'GopYController@gopYUpdate')->name('admin.gopy.update');
    Route::get('gop-y/delete/{id}', 'GopYController@gopYDelete')->name('admin.gopy.delete');

    Route::get('hoi-dap', 'HoiDapController@hoiDap')->name('admin.hoidap');
    Route::get('hoi-dap/{id}', 'HoiDapController@hoiDapChiTiet')->name('admin.hoidap.chitiet');
    Route::post('hoi-dap/insert', 'HoiDapController@hoiDapInsert')->name('admin.hoidap.insert');
    Route::post('hoi-dap/update/{id}', 'HoiDapController@hoiDapUpdate')->name('admin.hoidap.update');
    Route::get('hoi-dap/delete/{id}', 'HoiDapController@hoiDapDelete')->name('admin.hoidap.delete');

    Route::get('nhan-bai-viet', 'NhanBaiVietController@nhanBaiViet')->name('admin.nhanbaiviet');
    Route::get('nhan-bai-viet/{id}', 'NhanBaiVietController@nhanBaiVietChiTiet')->name('admin.nhanbaiviet.chitiet');
    Route::post('nhan-bai-viet/insert', 'NhanBaiVietController@nhanBaiVietInsert')->name('admin.nhanbaiviet.insert');
    Route::post('nhan-bai-viet/update/{id}', 'NhanBaiVietController@nhanBaiVietUpdate')->name('admin.nhanbaiviet.update');
    Route::get('nhan-bai-viet/delete/{id}', 'NhanBaiVietController@nhanBaiVietDelete')->name('admin.nhanbaiviet.delete');

    Route::get('research', 'ResearchController@research')->name('admin.research');
    Route::get('research/{id}', 'ResearchController@researchChiTiet')->name('admin.research.chitiet');
    Route::post('research/insert', 'ResearchController@researchInsert')->name('admin.research.insert');
    Route::post('research/update/{id}', 'ResearchController@researchUpdate')->name('admin.research.update');
    Route::get('research/delete/{id}', 'ResearchController@researchDelete')->name('admin.research.delete');

    Route::get('cau-hinh-chung', 'CauHinhChungController@cauHinhChung')->name('admin.cauhinhchung');
    Route::get('cau-hinh-chung/{id}', 'CauHinhChungController@cauHinhChungChiTiet')->name('admin.cauhinhchung.chitiet');
    Route::post('cau-hinh-chung/insert', 'CauHinhChungController@cauHinhChungInsert')->name('admin.cauhinhchung.insert');
    Route::post('cau-hinh-chung/update/{id}', 'CauHinhChungController@cauHinhChungUpdate')->name('admin.cauhinhchung.update');
    Route::get('cau-hinh-chung/delete/{id}', 'CauHinhChungController@cauHinhChungDelete')->name('admin.cauhinhchung.delete');

    Route::get('phan-tich-du-lieu', 'AdminController@phanTichDuLieu')->name('admin.phantich.dulieu');
});
Auth::routes();
