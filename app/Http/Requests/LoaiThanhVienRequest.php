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
            'slug' => 'required',
            'name' => 'required',
            'intro' => 'required'
        ];
    }

    public function messages() {
        return [
            'slug.required' => 'Chưa chọn đường link cấu hình',
            'name.required' => 'Tên cấu hình không được để trống',
            'intro.required' => 'Mô tả cấu hình không được để trống'
        ];
    }
}
