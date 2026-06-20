<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
            'year' => ['required', 'integer', 'min:2000', 'max:2100'],
        ];

        if ($this->isMethod('POST')) {
            $rules['file'] = ['required', 'file', 'mimes:pdf', 'max:10240'];
        } else {
            $rules['file'] = ['nullable', 'file', 'mimes:pdf', 'max:10240'];
        }

        return $rules;
    }
}
