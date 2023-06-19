<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Propaganistas\LaravelPhone\PhoneNumber;

class EmployeeUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:employees,email,'.$this->employee->id, 'max:255'],
            'experience' => ['required', 'integer', 'max:5'],
            'phone' => ['required', 'max:255', 'phone:MM', 'unique:employees,phone,'.$this->employee->id],
            'address' => ['required', 'max:255'],
            'salary' => ['required', 'integer', 'max:10000000'],
            'vacation' => ['required', 'integer', 'max:30'],
            'city' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:10240']
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'phone' => (string) new PhoneNumber($this->phone, 'MM')
        ]);
    }
}
