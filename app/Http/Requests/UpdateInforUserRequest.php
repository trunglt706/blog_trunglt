<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInforUserRequest extends FormRequest
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
            'email' => 'required',
            'name' => 'required',
            'id_loaithanhvien' => 'required',
            'status' => 'required',
        ];
    }

    public function messages() {
        return [
            'email.required' => 'Email không được để trống!',
            'name.required' => 'Họ tên không được để trống!',
            'id_loaithanhvien.required' => 'Chưa chọn loại thành viên!',
            'status.required' => 'Chưa chọn trạng thái'
        ];
    }
}
