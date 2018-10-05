<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountUserRequest extends FormRequest
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
            'password' => 'required|min:6',
        ];
    }

    public function messages() {
        return [
            'password.required' => 'Mật khẩu không được để trống!',
            'password.min' => 'Độ dài mật khẩu không được bé hơn 6 ký tự!'
        ];
    }
}
