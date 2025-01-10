<?php

namespace App\Http\Requests;

use App\Constants\ResponseStatusCodeConstants;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => 'required|string|min:10',
            'password' => ['required', 'string', Password::min(6)->numbers()],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'response' => [
                    'errCode' => ResponseStatusCodeConstants::USER_CREATE_FAILED,
                    'errMsg' => ResponseStatusCodeConstants::$messages[ResponseStatusCodeConstants::USER_CREATE_FAILED],
                ]
            ], 422)
        );
    }
}
