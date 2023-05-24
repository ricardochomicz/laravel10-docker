<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupportRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'subject' => 'required|string|min:3|max:255|unique:supports,subject',
            'content' => 'required|string'
        ];
        if ($this->method() === 'PUT' || $this->method() === 'PATCH') {

            $rules['subject'] = [
                'required',
                'min:3',
                'max: 255',
                //"unique:supports,subject,{$this->id},id"
                Rule::unique('supports')->ignore($this->support ?? $this->id)
            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'subject.required' => 'Informe a dúvida.',
            'subject.min' => 'O campo dúvida no mínimo 3 caracteres.',
            'content.required' => 'Informe o conteúdo da dúvida.'
        ];
    }
}
