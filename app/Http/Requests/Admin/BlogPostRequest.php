<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogPostRequest extends FormRequest
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
    public function rules(): array
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('blog_posts', 'slug')->ignore($this->route('blog_post'))],
            'excerpt' => ['required', 'string', 'max:1000'],
            'content' => ['required', 'string'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['nullable', 'boolean'],
            'author_id' => ['nullable', 'exists:users,id'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
        ];

        if ($this->isMethod('post')) {
            $rules['featured_image'] = ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:5120'];
            $rules['images'] = ['nullable', 'array'];
            $rules['images.*'] = ['image', 'mimes:jpeg,jpg,png,gif,webp', 'max:5120'];
        } else {
            $rules['featured_image'] = ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:5120'];
            $rules['new_images'] = ['nullable', 'array'];
            $rules['new_images.*'] = ['image', 'mimes:jpeg,jpg,png,gif,webp', 'max:5120'];
            $rules['remove_images'] = ['nullable', 'array'];
            $rules['remove_images.*'] = ['string', 'max:500'];
        }

        return $rules;
    }
}
