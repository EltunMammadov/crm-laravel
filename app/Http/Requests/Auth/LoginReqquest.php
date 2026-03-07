<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\RequestFieldValidation;

class LoginReqquest extends FormRequest
{
    use RequestFieldValidation;
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
            'email' => ["required", "email"],
            'password' => ["required", "min:6", "max:24"]
        ];
    }

    public function attributes(): array
    {
        return [
            "email" => "E-poçt ünvanı",
            "password" => "Şifrə"
        ];
    }

    public function messages(): array
    {
        return [
            "email.required" => ":attribute mütləqdir",
            "email.email" => ":attribute standarda uyğun deyil",
            "password.required" => ":attribute mütləqdir",
            "password.min" => ":attribute minimum 3 simvol ola bilər",
            "password.max" => ":attribute maksimum 24 simvol ola bilər"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response() -> json([
                'success' => false,
                'message' => 'Bad Request',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
