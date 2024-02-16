<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->name),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'slug' => 'required|string|max:130',
            'logo' =>  $this->getValidationRule('logo'),
            'website' => 'required|url|max:255',
        ];
    }

    /**
     * @param String $key
     * @return string
     */
    public function getValidationRule(String $key): string
    {
        if (request()->hasFile($key)) {
            return "required|mimes:png,jpg,jpeg,gif,svg|max:5196";
        }
        return "nullable|string";
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(response()->error(['errors' => $errors], 422));
    }
}
