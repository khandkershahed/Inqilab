<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $newsId = $this->route('news');

        return [
            'title'                 => 'required|string|max:1000|unique:news,title,' . $newsId,
            'bangla_title'          => 'nullable|string|max:1000',
            'slug'                  => 'nullable|string|max:1000|unique:news,slug,' . $newsId,
            'tags'                  => 'nullable|string|max:1000',
            'summary'               => 'nullable|string',
            'bangla_summary'        => 'nullable|string',
            'content'               => 'nullable|string',
            'bangla_content'        => 'nullable|string',
            'video_url'             => 'nullable|url',
            'thumbnail'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'banner_image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'thumbnail'             => 'nullable|url',
            'banner_image'          => 'nullable|url',

            'category_id'           => 'nullable|exists:categories,id',
            'sub_category_id'       => 'nullable|exists:categories,id',
            'sub_sub_category_id'   => 'nullable|exists:categories,id',

            'meta_title'            => 'nullable|string|max:255',
            'meta_description'      => 'nullable|string',
            'meta_keywords'         => 'nullable|string',

            'author_id'             => 'nullable|exists:users,id',
            'status'                => 'required|in:draft,published,archived,unpublished',

            // Boolean flags (checkboxes)
            'is_featured'           => 'nullable|in:0,1',
            'is_most_read'          => 'nullable|in:0,1',
            'is_breaking'           => 'nullable|in:0,1',
            'show_on_homepage'      => 'nullable|in:0,1',
            'show_in_slider'        => 'nullable|in:0,1',
            'is_trending'           => 'nullable|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'                => 'The News Title is required.',
            'title.max'                     => 'The News Title may not be greater than :max characters.',
            'title.unique'                  => 'This title already exists.',
            'slug.unique'                   => 'The Slug has already been taken.',
            'video_url.url'                 => 'The Video URL must be a valid URL.',
            'thumbnail.image'               => 'The Thumbnail must be an image.',
            'thumbnail.max'                 => 'The Thumbnail may not be greater than :max kilobytes.',
            'banner_image.image'            => 'The Banner Image must be an image.',
            'banner_image.max'              => 'The Banner Image may not be greater than :max kilobytes.',
            'category_id.exists'            => 'The selected Category is invalid.',
            'sub_category_id.exists'        => 'The selected Subcategory is invalid.',
            'sub_sub_category_id.exists'    => 'The selected Sub-Subcategory is invalid.',
            'author_id.exists'              => 'The selected Author is invalid.',
            'status.required'               => 'The Status is required.',
            'status.in'                     => 'The selected Status is invalid.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title'                 => 'News Title',
            'bangla_title'          => 'Bangla Title',
            'slug'                  => 'Slug',
            'tags'                  => 'Tags',
            'summary'               => 'Summary',
            'bangla_summary'        => 'Bangla Summary',
            'content'               => 'Content',
            'bangla_content'        => 'Bangla Content',
            'video_url'             => 'Video URL',
            'thumbnail'             => 'Thumbnail Image',
            'banner_image'          => 'Banner Image',
            'category_id'           => 'Category',
            'sub_category_id'       => 'Subcategory',
            'sub_sub_category_id'   => 'Sub-subcategory',
            'meta_title'            => 'Meta Title',
            'meta_description'      => 'Meta Description',
            'meta_keywords'         => 'Meta Keywords',
            'author_id'             => 'Author',
            'status'                => 'Status',
            'is_featured'           => 'Featured',
            'is_most_read'          => 'Most Read',
            'is_breaking'           => 'Breaking News',
            'show_on_homepage'      => 'Show on Homepage',
            'show_in_slider'        => 'Show in Slider',
            'is_trending'           => 'Trending',
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
