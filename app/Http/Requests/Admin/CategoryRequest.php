<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    // public function rules(): array
    // {
    //     $categoryId = $this->route('category') ?? null;
    // switch ($this->method()) {
    //     case 'POST':
    //     case 'PUT':
    //     case 'PATCH':
    // return [
    //     'name'         => [
    //         'required',
    //         'string',
    //         'max:255',
    //         Rule::unique('categories', 'name')->ignore($categoryId),
    //     ],
    //     'parent_id'    => 'nullable|exists:categories,id',
    //     'logo'         => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp,bmp,tiff,ico|max:2048',
    //     'image'        => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp,bmp,tiff,ico|max:2048',
    //     'banner_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp,bmp,tiff,ico|max:2048',
    //     'url'          => 'nullable|url|max:255',
    //     'status'       => 'required|in:inactive,active',
    // ];

    // case 'DELETE':
    //     return [];
    // default:
    //     return [];
    // }
    // }

    public function rules(): array
    {
        $categoryId = $this->route('category'); // Will be null on create

        return [
            'name' => [
                'required',
                'string',
                'max:1000',
                Rule::unique('categories', 'name')->ignore($categoryId),
            ],
            'bangla_name' => [
                'required',
                'string',
                'max:1000',
                Rule::unique('categories', 'bangla_name')->ignore($categoryId),
            ],
            // 'serial' => [
            //     'nullable',
            //     'string',
            //     'max:1000',
            //     Rule::unique('categories', 'serial')->ignore($categoryId),
            // ],
            'code' => [
                'nullable',
                'string',
                'max:1000',
                Rule::unique('categories', 'code')->ignore($categoryId),
            ],
            'parent_id'     => 'nullable|exists:categories,id',
            // 'logo'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            // 'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            // 'banner_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status'        => 'required|in:inactive,active',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->recordErrorMessages($validator);
        parent::failedValidation($validator);
    }

    protected function recordErrorMessages(Validator $validator): void
    {
        foreach ($validator->errors()->all() as $error) {
            Session::flash('error', $error);
        }
    }
}
