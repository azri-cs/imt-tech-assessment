<?php

namespace App\Http\Requests;

use App\Constants\ResponseStatusCodeConstants;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteUserRequest extends FormRequest
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
            'id' => 'required|int|exists:users,id',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'response' => [
                    'errCode' => ResponseStatusCodeConstants::USER_DELETE_FAILED,
                    'errMsg' => ResponseStatusCodeConstants::$messages[ResponseStatusCodeConstants::USER_DELETE_FAILED],
                ]
            ], 422)
        );
    }
}
