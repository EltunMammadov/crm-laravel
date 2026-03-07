<?php

namespace App\Http\Requests\Todo;

use App\Traits\RequestFailedValidation;
use App\Traits\RequestFieldValidation;
use Illuminate\Foundation\Http\FormRequest;

class CreateTodoRequest extends FormRequest
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
            "start_date" => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'status' => ['required'],
            'description' => ['nullable'],
            'service_id' => ['required', 'integer'],
            'customer_id' => ['required', 'integer']
        ];
    }
}
