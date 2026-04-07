<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0.01',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status'      => 'required|in:draft,published',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Tên khóa học không được để trống.',
            'price.required'   => 'Giá khóa học là bắt buộc.',
            'price.numeric'    => 'Giá phải là số.',
            'price.min'        => 'Giá khóa học phải lớn hơn 0.',
            'status.required'  => 'Trạng thái là bắt buộc.',
            'status.in'        => 'Trạng thái chỉ được là draft hoặc published.',
        ];
    }
}
