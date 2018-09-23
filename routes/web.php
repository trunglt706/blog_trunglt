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
Route::get('/gioi-thieu', 'HomeController@introduce')->name('introduce');
Route::get('/search', 'HomeController@search')->name('search');

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

    Route::get('loai-thanh-vien', 'AdminController@loaiThanhVien')->name('admin.loaithanhvien');
    Route::get('loai-thanh-vien/{id}', 'AdminController@loaiThanhVienChiTiet')->name('admin.loaithanhvien.chitiet');
    Route::post('loai-thanh-vien/insert', 'AdminController@loaiThanhVienInsert')->name('admin.loaithanhvien.insert');
    Route::post('loai-thanh-vien/update', 'AdminController@loaiThanhVienUpdate')->name('admin.loaithanhvien.update');
    Route::get('loai-thanh-vien/delete', 'AdminController@loaiThanhVienDelete')->name('admin.loaithanhvien.delete');

    Route::get('danh-muc', 'AdminController@danhMuc')->name('admin.danhmuc');
    Route::get('danh-muc/{id}', 'AdminController@danhMucChiTiet')->name('admin.danhmuc.chitiet');
    Route::post('danh-muc/insert', 'AdminController@danhMucInsert')->name('admin.danhmuc.insert');
    Route::post('danh-muc/update', 'AdminController@danhMucUpdate')->name('admin.danhmuc.update');
    Route::get('danh-muc/delete', 'AdminController@danhMucDelete')->name('admin.danhmuc.delete');

    Route::get('bai-viet', 'AdminController@baiViet')->name('admin.baiviet');
    Route::get('bai-viet/{id}', 'AdminController@baiVietChiTiet')->name('admin.baiviet.chitiet');
    Route::post('bai-viet/insert', 'AdminController@baiVietInsert')->name('admin.baiviet.insert');
    Route::post('bai-viet/update', 'AdminController@baiVietUpdate')->name('admin.baiviet.update');
    Route::get('bai-viet/delete', 'AdminController@baiVietDelete')->name('admin.baiviet.delete');

    Route::get('thanh-vien', 'AdminController@thanhVien')->name('admin.thanhvien');
    Route::get('thanh-vien/{id}', 'AdminController@thanhVienChiTiet')->name('admin.thanhvien.chitiet');
    Route::post('thanh-vien/insert', 'AdminController@thanhVienInsert')->name('admin.thanhvien.insert');
    Route::post('thanh-vien/update/info', 'AdminController@thanhVienUpdateInfo')->name('admin.thanhvien.update.info');
    Route::post('thanh-vien/update/account', 'AdminController@thanhVienUpdateAccount')->name('admin.thanhvien.update.account');
    Route::get('thanh-vien/delete', 'AdminController@thanhVienDelete')->name('admin.thanhvien.delete');
    Route::post('thanh-vien/block', 'AdminController@thanhVienBlock')->name('admin.thanhvien.block');

    Route::get('quang-cao', 'AdminController@quangCao')->name('admin.quangcao');
    Route::get('quang-cao/{id}', 'AdminController@quangCaoChiTiet')->name('admin.quangcao.chitiet');
    Route::post('quang-cao/insert', 'AdminController@quangCaoInsert')->name('admin.quangcao.insert');
    Route::post('quang-cao/update', 'AdminController@quangCaoUpdate')->name('admin.quangcao.update');
    Route::get('quang-cao/delete', 'AdminController@quangCaoDelete')->name('admin.quangcao.delete');

    Route::get('gop-y', 'AdminController@gopY')->name('admin.gopy');
    Route::get('gop-y/{id}', 'AdminController@gopYChiTiet')->name('admin.gopy.chitiet');
    Route::post('gop-y/insert', 'AdminController@gopYInsert')->name('admin.gopy.insert');
    Route::post('gop-y/update', 'AdminController@gopYUpdate')->name('admin.gopy.update');
    Route::get('gop-y/delete', 'AdminController@gopYDelete')->name('admin.gopy.delete');

    Route::get('hoi-dap', 'AdminController@hoiDap')->name('admin.hoidap');
    Route::get('hoi-dap/{id}', 'AdminController@hoiDapChiTiet')->name('admin.hoidap.chitiet');
    Route::post('hoi-dap/insert', 'AdminController@hoiDapInsert')->name('admin.hoidap.insert');
    Route::post('hoi-dap/update', 'AdminController@hoiDapUpdate')->name('admin.hoidap.update');
    Route::get('hoi-dap/delete', 'AdminController@hoiDapDelete')->name('admin.hoidap.delete');

    Route::get('nhan-bai-viet', 'AdminController@nhanBaiViet')->name('admin.nhanbaiviet');
    Route::get('nhan-bai-viet/{id}', 'AdminController@nhanBaiVietChiTiet')->name('admin.nhanbaiviet.chitiet');
    Route::post('nhan-bai-viet/insert', 'AdminController@nhanBaiVietInsert')->name('admin.nhanbaiviet.insert');
    Route::post('nhan-bai-viet/update', 'AdminController@nhanBaiVietUpdate')->name('admin.nhanbaiviet.update');
    Route::get('nhan-bai-viet/delete', 'AdminController@nhanBaiVietDelete')->name('admin.nhanbaiviet.delete');

    Route::get('research', 'AdminController@research')->name('admin.research');
    Route::get('research/{id}', 'AdminController@researchChiTiet')->name('admin.research.chitiet');
    Route::post('research/insert', 'AdminController@researchInsert')->name('admin.research.insert');
    Route::post('research/update', 'AdminController@researchUpdate')->name('admin.research.update');
    Route::get('research/delete', 'AdminController@researchDelete')->name('admin.research.delete');

    Route::get('cau-hinh-chung', 'AdminController@cauHinhChung')->name('admin.cauhinhchung');
    Route::get('cau-hinh-chung/{id}', 'AdminController@cauHinhChungChiTiet')->name('admin.cauhinhchung.chitiet');
    Route::post('cau-hinh-chung/insert', 'AdminController@cauHinhChungInsert')->name('admin.cauhinhchung.insert');
    Route::post('cau-hinh-chung/update', 'AdminController@cauHinhChungUpdate')->name('admin.cauhinhchung.update');
    Route::get('cau-hinh-chung/delete', 'AdminController@cauHinhChungDelete')->name('admin.cauhinhchung.delete');

    Route::get('phan-tich-du-lieu', 'AdminController@phanTichDuLieu')->name('admin.phantich.dulieu');
});
Auth::routes();
