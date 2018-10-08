<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LikeBaiVietRequest extends FormRequest
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
        ];
    }

    public function messages() {
        return [
            'slug.required' => 'Lỗi, không xác định được bài viết',
        ];
    }
}
