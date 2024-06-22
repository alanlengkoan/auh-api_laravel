<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthRequest extends FormRequest
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
            // 'name'     => 'required',
            // 'email'    => 'required|email|unique:users',
            // 'password' => 'required|confirmed|min:8|max:50',

            'name'     => ['required'],
            'email'    => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'Name wajib',
            'email.required'     => 'Email wajib',
            'email.email'        => 'Email is invalid',
            'email.unique'       => 'Email is already taken',
            'password.required'  => 'Password wajib',
            'password.confirmed' => 'Password confirmation wajib',
            'password.min'       => 'Password must be at least 8 characters',
            'password.max'       => 'Password must not exceed 50 characters',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => true
        ], 422));
    }
}
