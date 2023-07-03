<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Propaganistas\LaravelPhone\PhoneNumber;

class AdminStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'phone' => (string) new PhoneNumber($this->phone, 'MM')
        ]);
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
            'username' => ['required', 'max:255', 'unique:users'],
            'email' => ['required', 'email', 'unique:users', 'max:255'],
            'phone' => ['required', 'max:255', 'phone:MM', 'unique:users'],
            'password' => ['required', 'min:5', 'max:20'],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:10240'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated();
        $validated['password'] = bcrypt($validated['password']);
        return $validated;
    }
}
