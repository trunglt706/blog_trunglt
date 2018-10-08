<?php

namespace App\Http\Controllers;

use App\baiviets;
use App\danhmucbaiviets;
use App\hoidap;
use App\Http\Requests\LienHeRequest;
use App\Http\Requests\NhanBaiVietRequest;
use App\Http\Requests\PhanHoiRequest;
use App\Http\Requests\LikeBaiVietRequest;
use App\Http\Requests\ResetUpdatePassword;
use App\lienhe;
use App\nhanbaiviets;
use App\phanhois;
use App\quangcaos;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Mail\ResetPassword;
use Mail;
use Auth;

class HomeController extends Controller {

    /**
     * @function go to home page
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //get 5 lasted news
        $data['news'] = baiviets::where('status', 1)->orderBy('created_at')->limit(5)->get();
        //get news important
        $data['important'] = baiviets::where('important', 1)->where('status', 1)->first();
        //get 2 advs
        $data['advs'] = quangcaos::where('status', 1)->orderBy('status', 'asc')->limit(2)->get();
        return view('home', compact('data'));
    }

    /**
     * @function go to contact page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact() {
        return view('contact');
    }

    /**
     * @function go to answer and question page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function hoidap() {
        //Get list hoidap
        $data['hoidap'] = hoidap::where('status', 1)->orderBy('order', 'asc')->get();
        return view('hoidap', compact('data'));
    }

    /**
     * @function get list baiviet
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function danhmuc_baiviet($slug) {
        //Lay chi tiet danh muc bai viet
        $data['danhmuc'] = danhmucbaiviets::where('slug', $slug)->where('status', 1)->first();
        if (!is_null($data['danhmuc'])) {
            //Lay danh sach bai viet cua danh muc
            $data['list_baiviet'] = baiviets::where('id_danhmuc', $data['danhmuc']->id)->where('status', 1)->orderBy('created_at')->paginate(6);
            //Lay danh sach 5 bai viet co luot view cao nhat
            $data['list_view'] = baiviets::where('status', 1)->orderBy('view', 'desc')->limit(5)->get();
            //Lay danh sach 3 bai viet co luot like cao nhat
            $data['list_like'] = baiviets::where('status', 1)->orderBy('like', 'desc')->limit(3)->get();
            return view('danhmuc-baiviet', compact('data'));
        } else {
            return route('home')->with('error', 'Danh mục này không tồn tại!');
        }
    }

    /**
     * @function go to detail baiviet
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function baiviet($slug) {
        $bv = baiviets::where('slug', $slug)->where('status', 1)->first();
        if (!is_null($bv)) {
            $object['image'] = url($bv->thumn);
            $object['title'] = $bv->name;
            $object['intro'] = $bv->intro;
            $object['keyword'] = $bv->keyword;
            $object['url'] = route('detail.baiviet', ['slug' => $slug]);
            $bv->view += 1;
            $bv->save();

            //Lay chi tiet bai viet
            $data['news'] = baiviets::where('slug', $slug)->where('status', 1)->first();
            //Lay danh sach binh luan da duoc duyet cua bai viet
            $data['comment'] = phanhois::where('id_baiviet', $data['news']->id)->where('status', 1)->orderBy('created_at', 'desc')->get();
            //Lay danh muc bai viet
            $data['danhmuc'] = danhmucbaiviets::where('id', $data['news']->id_danhmuc)->where('status', 1)->first();
            //Lay danh sach 5 bai viet co luot view cao nhat khac voi bai viet hien tai
            $data['list_view'] = baiviets::where('status', 1)->where('slug', '<>', $slug)->orderBy('view', 'desc')->limit(5)->get();
            //Lay danh sach 3 bai viet co luot like cao nhat khac voi bai viet hien tai
            $data['list_like'] = baiviets::where('status', 1)->where('slug', '<>', $slug)->orderBy('like', 'desc')->limit(3)->get();
            //Lay danh sach bai viet cung danh muc
            $data['new_other'] = baiviets::where('id_danhmuc', $data['news']->id_danhmuc)->where('id', '<>', $data['news']->id)->where('status', 1)->orderBy('created_at', 'desc')->limit(3)->get();
            return view('detail-baiviet', ['data' => $data, 'object' => $object]);
        } else {
            return redirect()->route('home')->with('error', 'Bài viết này không tồn tại!');
        }
    }

    /**
     * @function go to gioithieu page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function introduce() {
        return view('gioi-thieu');
    }

    /**
     * @function go to search page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request) {
        $key = $request->key;
        //Lay danh sach bai viet cua danh muc
        $data['list_baiviet'] = baiviets::where("name", "like", "%" . $key . "%")->orWhere("keyword", "like", "%" . $key . "%")->orWhere("intro", "like", "%" . $key . "%")->where('status', 1)->orderBy('created_at')->paginate(6);
        //Lay danh sach 5 bai viet co luot view cao nhat
        $data['list_view'] = baiviets::where('status', 1)->orderBy('view', 'desc')->limit(5)->get();
        //Lay danh sach 3 bai viet co luot like cao nhat
        $data['list_like'] = baiviets::where('status', 1)->orderBy('like', 'desc')->limit(3)->get();
        return view('search', compact('data'));
    }

    /**
     * @function post data by ajax
     * @param Request $request
     */
    public function searchAjax(Request $request) {
        $data = baiviets::where("name", "like", "%" . $request->key . "%")
                        ->where("keyword", "like", "%" . $request->key . "%")
                        ->where("status", 1)
                        ->orderBy('created_at')->paginate(10);
        echo $data;
    }

    /**
     * @function dang ky nhan bai viet by ajax
     * @param NhanBaiVietRequest $request
     */
    public function dangky_nhanbaiviet(NhanBaiVietRequest $request) {
        try {
            //Kiem tra da dang ky truoc do chua
            $dky = nhanbaiviets::where('email', $request->email)->first();
            if (!is_null($dky)) {
                echo ['status' => 'error', 'ms' => 'Bạn đã đăng ký trước đó rồi!'];
            } else {
                $nhan = new nhanbaiviets();
                $nhan->email = $request->email;
                $nhan->save();
                echo ['status' => 'success', 'ms' => 'Đăng ký nhận bài viết thành công'];
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            echo ['status' => 'success', 'ms' => 'Lỗi, đăng ký nhận bài viết thất bại!'];
        }
    }

    /**
     * @function store comment of user
     * @param PhanHoiRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postPhanHoi(PhanHoiRequest $request) {
        $bviet = baiviets::where('id', $request->id_baiviet)->where('status', 1)->first();
        if (!is_null($bviet)) {
            try {
                $phoi = new phanhois();
                $phoi->email = $request->email;
                $phoi->name = $request->name;
                $phoi->content = $request->content;
                $phoi->id_baiviet = $request->id_baiviet;
                $phoi->status = 0;
                $phoi->save();
                return redirect()->route('detail.baiviet', ['slug' => $bviet->slug])->with('success', 'Gửi bình luận thành công, bình luận của bạn sẽ được hiển thị sau khi admin kiểm duyệt hoàn tất.');
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                return redirect()->route('detail.baiviet', ['slug' => $bviet->slug])->with('error', 'Lỗi, gửi bình luận cho bài viết thất bại!');
            }
        } else {
            return redirect()->route('home')->with('error', 'Lỗi, bài viết này không tồn tại!');
        }
    }

    /**
     * @function store contact of user
     * @param LienHeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLienHe(LienHeRequest $request) {
        try {
            //Kiem tra so lan gui lien he
            $lhe = lienhe::where('email', $request->email)->whereDate('created_at', Carbon::today())->count();
            if ($lhe >= 3) {
                return redirect()->route('contact')->with('error', 'Lỗi, hôm nay bạn đã gửi thông tin liên hệ quá 3 lần. Vui lòng gửi tiếp cho chúng tôi vào ngày khác!');
            } else {
                $lhe = new lienhe();
                $lhe->email = $request->email;
                $lhe->name = $request->name;
                $lhe->content = $request->content;
                $lhe->status = 0;
                $lhe->save();
                return redirect()->route('contact')->with('success', 'Gửi thông tin thành công, cảm ơn bạn đã gửi thông tin liên hệ đến chúng tôi.');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('contact')->with('error', 'Lỗi, gửi thông tin liên hệ thất bại!');
        }
    }
    
    /**
     * @function go to author index page
     * @param string $username
     * @return view
     */
    public function getAuthor($username) {
        //Get infor author
        if($username != 'admin') {
            $object['author'] = \App\users::select(['username', 'email', 'intro', 'name', 'avatar', 'background'])->where('username', $username)->where('status', 1)->first();
        } else {
            $object['author'] = \App\admins::select(['username', 'email', 'intro', 'name', 'avatar', 'background'])->where('username', $username)->first();
        }
        //Get list baiviet of author
        $object['list_bviet'] = baiviets::where('username', $object['author']->username)->where('status', 1)->orderBy('view', 'desc')->get();
        return view('author_index', ['object' => $object]);
    }
    
    /**
     * @function do to list author
     * @return view
     */
    public function listAuthor(Request $request) {
        $admins = array();
        $users = array();
        $a = NULL;
        $b = NULL;
        $key = NULL;
        if(isset($request->key) && ($request->key != '')) {
            $key = $request->key;
            $list_author = \App\users::where('status', 1)->where('username', 'like', '%'.$request->key.'%')->orWhere('name', 'like', '%'.$request->key.'%')->orWhere('email', 'like', '%'.$request->key.'%')->get();
            $list_admin = \App\admins::where('username', 'like', '%'.$request->key.'%')->orWhere('name', 'like', '%'.$request->key.'%')->orWhere('email', 'like', '%'.$request->key.'%')->get();
        } else {
            $list_author = \App\users::where('status', 1)->get();        
            $list_admin = \App\admins::all();
        }
//        Add value into array admin
        if(!is_null($list_admin)) {
            foreach ($list_admin as $ad) {
                $a[] = array(
                    'username' => $ad->username,
                    'email' => $ad->email,
                    'name' => $ad->name,
                    'avatar' => $ad->avatar
                );
            }
            $admins = $a;
        }
//        Add value into array user
        if(!is_null($list_author)) {
            foreach ($list_author as $au) {
                $b[] = array(
                    'username' => $au->username,
                    'email' => $au->email,
                    'name' => $au->name,
                    'avatar' => $au->avatar
                );
            }
            $users = $b;
        }
        return view('list_author', ['list_author_user' => $list_author, 'list_author_admin' => $list_admin, 'key_author' => $key]);
    }
    
    /**
     * @function author like baiviet
     * @param \App\Http\Controllers\LiekBaiVietRequest $request
     * @return array
     */
    public function baivietLike(LikeBaiVietRequest $request) {
        $bviet = baiviets::where('slug', $request->slug)->where('status', 1)->first();
        if(!is_null($bviet)) {
            $bviet->like += 1;
            $bviet->save();
            return array('status' => 'success', 'msg' => 'Cảm ơn bạn đã like cho bài viết này');
        } else {
            return array('status' => 'error', 'msg' => 'Lỗi, bài viết không tồn tại!');
        }
    }
    
    /**
     * @function got to reset password page
     * @return view
     */
    public function resetPasswordAdmin() {
        return view('auth.passwords.email', ['author' => 'admin']);
    }
    
    /**
     * @function send link accept reset password
     * @param Request $request
     */
    public function postResetPassword(Request $request) {
        if($request->author == "admin") {
            $user = \App\admins::where('email', $request->email)->first();
        } else {
            $user = \App\users::where('email', $request->email)->where('status', 1)->first();
        }
        $user->email_verified_at = bin2hex(random_bytes(10));
        $user->save();
        Mail::to($user->email)->send(new ResetPassword($user, $request->author));
    }
    
    /**
     * @function accept reset password
     * @param string $token
     * @param Request $request
     * @return view
     */
    public function acceptResetPassword($token, Request $request) {
        if($request->author == "admin") {
            $user = \App\admins::where('email_verified_at', $token)->first();
        } else {
            $user = \App\users::where('email_verified_at', $token)->where('status', 1)->first();
        }
        if(!is_null($user)) {
            return view('auth.passwords.reset', ['token' => $token, 'author' => $request->author, 'email' => $user->email]);
        } else {
            return redirect()->route('reset.password.admin')->with('error', 'Người dùng này không tồn tại!');
        }
    }
    
    /**
     * @function update password reset
     * @param ResetUpdatePassword $request
     * @return view
     */
    public function updateResetPassword(ResetUpdatePassword $request) {
        if($request->author == "admin") {
            $user = \App\admins::where('email_verified_at', $request->token)->where('email', $request->email)->first();
        } else {
            $user = \App\users::where('email_verified_at', $request->token)->where('email', $request->email)->where('status', 1)->first();
        }
        if(!is_null($user)) {
            $user->password = bcrypt($request->password);
            $user->email_verified_at = "";
            $user->save();
            if($request->author == "admin") {
                Auth::guard('admin')->login($user);
                return redirect()->route('admin.index')->with('success', 'Khôi phục mật khẩu thành công');
            } else {
                Auth::guard('web')->login($user);
                return redirect()->route('user.index')->with('success', 'Khôi phục mật khẩu thành công');
            }
        } else {
            return redirect()->route('reset.password.admin')->with('error', 'Người dùng này không tồn tại!');
        }
    }

}
