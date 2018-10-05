<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CauHinhChungUpdateRequest extends FormRequest
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
            'type' => 'required',
            'name' => 'required',
            'intro' => 'required'
        ];
    }

    public function messages() {
        return [
            'type.required' => 'Loại cấu hình không được để trống',
            'name.required' => 'Tên cấu hình không được để trống',
            'intro.required' => 'Mô tả cấu hình không được để trống'
        ];
    }
}
