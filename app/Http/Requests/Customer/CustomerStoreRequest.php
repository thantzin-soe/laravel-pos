<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Propaganistas\LaravelPhone\PhoneNumber;

class CustomerStoreRequest extends FormRequest
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
            'email' => ['required', 'email', 'unique:customers', 'max:255'],
            'phone' => ['required', 'max:255', 'phone:MM', 'unique:customers'],
            'address' => ['required', 'max:255'],
            'shopname' => ['required', 'max:255'],
            'account_holder' => ['required', 'max:255'],
            'account_number' => ['required', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:10240'],
            'bank_name' => ['nullable', 'max:255'],
            'bank_branch' => ['nullable', 'max:255'],
            'city' => ['nullable', 'max:255'],
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
