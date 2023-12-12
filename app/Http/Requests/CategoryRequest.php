<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_name'=>'required|unique:categories',
            'category_photo'=>'required',
            'category_photo'=>'image',
            // 'category_photo'=>'max:512',
        ];
    }
    public function messages(): array
    {
        return [
            'category_name.required'=>'category nam de!',
            'category_photo.required'=>'category photo nam de!',
            'category_photo.image'=>'category image type e dite hobe!',
            // 'category_photo.max'=>'category image 512 kb boro dibi na',
        ];
    }
}
