<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'stripe_token' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'stripe_token.required' => 'Stripe token is required'
        ];
    }
}
