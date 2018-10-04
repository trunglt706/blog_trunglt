<?php

namespace App\Http\Controllers\Auth;

use App\admins;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Login admin page
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginAdmin(LoginRequest $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.index')->with('success', 'Đăng nhập hệ thống thành công');
        } else {
            return redirect()->route('login')->with('error', 'Lỗi, tên tài khoản hoặc mật khẩu không chính xác!');
        }
    }
}
