<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
            'code' => ['required', 'string', 'max:255'],
            'garage' => ['required', 'string', 'max:255'],
            'store' => ['required', 'string', 'max:255'],
            'buying_date' => ['required', 'date'],
            'expire_date' => ['required', 'date'],
            'buying_price' => ['required', 'integer'],
            'selling_price' => ['required', 'integer'],
            'image' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,jpg,png,webp,gif']
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "The product name is required.",
            "category_id.required" => "The category field is required.",
            "supplier_id.required" => "The supplier field is required.",
            "code.required" => "The product code field is required.",
            "garage.required" => "The garage field is required.",
            "store.required" => "The store field is required.",
            "buying_date.required" => "The buying date field is required.",
            "expire_date.required" => "The expire date field is required.",
            "buying_price.required" => "The buying price field is required.",
            "selling_price.required" => "The selling price field is required.",
        ];
    }
}
