<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetUpdatePassword extends FormRequest
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
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email không được để trống',
            'password.min' => 'Mật khẩu phải có tối thiểu 6 ký tự',
            'password.required' => 'Mật khẩu không được để trống',
            'password_confirmation.required' => 'Mật khẩu xác nhận không được để trống',
            'password_confirmation.same' => 'Mật khẩu xác nhận không chính xác!'
        ];
    }
}
