<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
        return [
            'name'=>'required|string',
            'email' => 'required|email|unique:users',
            'password'=> 'required|string|confirmed|min:8'
        ];
    }

    public function messages()
    {
        return[
            'name.required'=>'Name is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'Email has already been taken.',
            'password.required'=>'Password is required.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min'=>'Password must be at least 8 characters.'
        ];
    }
}
