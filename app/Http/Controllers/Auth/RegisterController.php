<?php

namespace App\Http\Controllers\Auth;

use App\users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Mail;
use App\Mail\ActiveUser;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6|confirmed',
                    'g-recaptcha-response' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
        $loaitv = \App\loaithanhviens::where('slug', 'member-chuan')->first();
        $ar = array(
                    'id_loaithanhvien' => $loaitv->id,
                    'username' => substr(md5(microtime()), rand(0, 15), 15),
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'active_code' => str_random(60),
                    'status' => -1,
                    'created_at' => date('Y-m-d H:i:s')
        );
        users::insertUser($ar);
    }

    /**
     * @function register new account
     * @param Request $request
     * @return view
     */
    public function register(Request $request) {
        $this->validator($request->all())->validate();
        $input = $request->only('name', 'email', 'password');
        try {
            $this->create($input);
            $data = users::where('email', $input['email'])->first();
            Mail::to($input['email'])->send(new ActiveUser($data->name, $data->active_code));
            return redirect()->route("login")->with("status", "Đăng ký thành công");
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->route('register')->with("error", "Lỗi, đăng ký thất bại!");
        }
    }

}
