<?php

namespace App\Http\Requests;

use App\Constants\ResponseStatusCodeConstants;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
            'id' => 'required|int|exists:users,id',
            'name' => 'required|string|between:2,100',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->id)],
            'phone' => 'required|string|min:10',
        ];

        if ($this->filled('password')) {
            $rules['password'] = ['required', 'string', Password::min(6)->numbers()];
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'response' => [
                    'errCode' => 1001, //Different error should have different status code, for the sake of this test it is hardcoded
                    'errMsg' => ResponseStatusCodeConstants::$messages[ResponseStatusCodeConstants::USER_UPDATE_FAILED],
                ]
            ], 422)
        );
    }
}
