<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RechargePayPalRequest extends FormRequest
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
            'amount' => 'required|numeric|min:4.35|max:1000',
            'phone' => 'required',
        ];
    }

    public function messages() {
        return [
            'amount.required' => 'Vui lòng nhập số tiền bạn muốn nạp',
            'amount.numeric' => 'Giá trị nhập vào không phải là số',
            'amount.min' => 'Bạn cần nhập số tiền lớn hơn hoặc bằng 4.35 USD',
            'amount.max' => 'Bạn cần nhập số tiền nhỏ hơn hoặc bằng 1.000 USD',
            'phone' => 'Vui lòng nhập số điện thoại',
        ];
    }
}
