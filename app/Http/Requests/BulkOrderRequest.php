<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;

class BulkOrderRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        // dd($this->id);
        return [
            'name' => 'required',
            'email' => 'required',
            'company_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'country' => 'required',
            'requirement' => 'required',
            'quantity' => 'required',
            'bulk_sample_val' => 'required',
            
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Please fill the name field',
            'email.required' => 'Please add the email address',
            'company_name.required' => 'Please add company name',
            'phone.required' => 'Please add the phone number',
            'country.required' => 'Please select the country',
            'address.required' => 'Please add the address',
            'requirement.required' => 'Please add the requirement of sample order',
            'quantity.required' => 'Please add the quantity',
            'bulk_sample_val.required' => 'Please add sample image',
        ];
    }
    public function after(): array
    {
        return [
            function (Validator $validator) { 
                foreach($validator->errors()->toArray() as $msgError)
                {
                    return back()->with('error', $msgError[0]);
                }
            }
        ];
    }
}
