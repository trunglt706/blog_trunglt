<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoaiThanhVienRequest extends FormRequest
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
            'mark' => 'required|integer',
            'name' => 'required',
            'intro' => 'required'
        ];
    }

    public function messages() {
        return [
            'mark.required' => 'Chưa nhập số điểm',
            'mark.integer' => 'Số điểm phải là số nguyên',
            'name.required' => 'Tên cấu hình không được để trống',
            'intro.required' => 'Mô tả cấu hình không được để trống'
        ];
    }
}
