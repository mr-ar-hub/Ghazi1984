<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(Request $request): array
    {
        // dd($this->id);
        return [
            'first_name' => 'required',
            'last_name' => 'nullable',
            'company_name' => 'nullable',
            'country' => 'required',
            'street_address' => 'nullable',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'nullable',
            'phone' => 'required',
            'email' => 'nullable',
            'order_note' => 'nullable',
            'order_total' => 'nullable',
            'payment_method' => 'nullable',
            'order_note' => 'nullable',
            
        ];
    }
    public function messages(): array
    {
        return [
            'first_name.required' => 'Please fill the name field',
            'country.required' => 'Please select the country name',
            'street_address.required' => 'Please fill the street address field',
            'city.required' => 'Please fill the city field',
            'state.required' => 'Please fill the state field',
            'postal_code.required' => 'Please fill the postal code field',
            'phone.required' => 'Please fill the phone field',
            'email.required' => 'Please fill the email field',
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
