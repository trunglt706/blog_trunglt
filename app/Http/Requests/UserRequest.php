<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Họ tên không được để trống!',
            'email.required' => 'Email không được để trống!',
            'email.unique' => 'Email này đã có người đăng ký!',
            'password.required' => 'Mật khẩu không được để trống!',
            'password.min' => 'Độ dài mật khẩu không được bé hơn 6 ký tự!'
        ];
    }
}
