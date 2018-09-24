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
            'username' => 'required',
            'slug' => 'required',
            'name' => 'required|max:60',
            'intro' => 'required|max:300',
            'content' => 'required',
            'thumn' => 'required',
            'keyword' => 'required'
        ];
    }

    public function messages() {
        return [
            'id_danhmuc.required' => 'Chưa chọn danh mục',
            'username.required' => 'Chưa xác định được tác giả đăng bài viết',
            'slug.required' => 'Đường lick bài viết chưa được tạo',
            'name.max' => 'Tên bài viết quá dài (max: 60 ký tự)',
            'name.required' => 'Tên bài viết không được để trống',
            'intro.required' => 'Mô tả bài viết không được để trống',
            'intro.max' => 'Mô tả bài viết quá dài (max: 300 ký tự)',
            'content.required' => 'Nội dung bài viết không được để trống',
            'thumn.required' => 'Chưa chọn hình ảnh bài viết',
            'keyword.required' => 'Chưa chọn từ khóa bài viết',
        ];
    }
}
