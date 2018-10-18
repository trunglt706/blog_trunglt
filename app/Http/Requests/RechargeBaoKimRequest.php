<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RechargeBaoKimRequest extends FormRequest
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
            'amount' => 'required|integer|min:100000|max:20000000',
            'method' => 'required',
            'phone' => 'required'
        ];
    }

    public function messages() {
        return [
            'amount.required' => 'Vui lòng nhập số tiền bạn muốn nạp',
            'amount.integer' => 'Số tiền phải là một số nguyên',
            'amount.min' => 'Bạn cần nhập số tiền lớn hơn hoặc bằng 100.000 VNĐ',
            'amount.max' => 'Bạn cần nhập số tiền nhỏ hơn hoặc bằng 20.000.000 VNĐ',
            'method:required' => 'Vui lòng chọn phương thức thanh',
            'phone:required' => 'Vui lòng nhập số điện thoại'
        ];
    }
}
