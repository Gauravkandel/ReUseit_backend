<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class userRequest extends FormRequest
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
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => ['required', 'regex:/^(98|97)\d{8}$/'],
            'password' => 'required | min:8',
            'email' => 'required | email | unique:users,email'
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $response = [
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $errors //get errors as response.data.errors.(phone/email and so on)
        ];
        throw new HttpResponseException(response()->json($response, 422));
    }
}
