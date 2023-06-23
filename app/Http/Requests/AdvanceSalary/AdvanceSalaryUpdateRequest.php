<?php

namespace App\Http\Requests\AdvanceSalary;

use Illuminate\Foundation\Http\FormRequest;

class AdvanceSalaryUpdateRequest extends FormRequest
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
            'employee_id' => ['required', 'integer', 'exists:employees,id'],
            'month' => ['required', 'max:255'],
            'year' => ['required', 'max:255'],
            'advance_salary' => ['required', 'integer', 'max:1000000']
        ];
    }
}
