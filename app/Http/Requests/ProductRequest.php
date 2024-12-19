<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ProductRequest extends FormRequest
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
            'cat_id' => 'required',
            'name' => 'required',
            'artical_name' => 'nullable',
            'price' => 'required',
            'discount' => 'nullable',
            'stock' => 'required',
            'status' => 'nullable',
            'gender' => 'nullable',
            'description' => 'required',
            'short_description' => 'nullable',
            'product_val' => 'required',
            'carousel_images_val' => 'required',
            'size_color_map' => 'nullable',
            // 'sizes' => 'nullable|array',
            // 'sizes.*' => 'nullable',
            // 'colors' => 'nullable|array',
            // 'colors.*' => 'nullable',
        ];
    }
    public function messages(): array
    {
        return [
            'cat_id.required' => 'Category is required',
            'name.required' => 'Product name is required',
            'price.required' => 'Product price is required',
            'stock.required' => 'Product stock is required',
            'description.required' => 'Product description is required',
            'product_val.required' => 'The product image field is required',
            'carousel_images_val.required' => 'The carousel image field is required',
        ];
    }
    public function after(): array
    {
        return [
            function (Validator $validator) {
                // dd($validator->errors()->toArray());  
                foreach($validator->errors()->toArray() as $msgError)
                {
                    // dd($msgError);
                    return back()->with('error', $msgError[0]);
                }
            }
        ];
    }
}
