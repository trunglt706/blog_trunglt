<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaiVietRequest extends FormRequest
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
            'id_danhmuc' => 'required',
            'name' => 'required',
            'intro' => 'required',
            'content' => 'required',
        ];
    }

    public function messages() {
        return [
            'id_danhmuc.required' => 'Chưa chọn danh mục',
            'name.required' => 'Tên bài viết không được để trống',
            'intro.required' => 'Mô tả bài viết không được để trống',
            'content.required' => 'Nội dung bài viết không được để trống',
        ];
    }
}
