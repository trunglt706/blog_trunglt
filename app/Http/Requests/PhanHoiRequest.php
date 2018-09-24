<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhanHoiRequest extends FormRequest
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
            'email' => 'required|email',
            'name' => 'required',
            'content' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ];
    }

    public function messages() {
        return [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email nhập vào không đúng định dạng',
            'name.required' => 'Họ tên không được để trống',
            'content.required' => 'Nội dung bình luận không được để trống',
            'g-recaptcha-response.required' => 'Chưa chọn recaptcha',
            'g-recaptcha-response.captcha' => 'Lỗi recaptcha',
        ];
    }
}
