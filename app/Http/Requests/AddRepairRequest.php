<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRepairRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cust_name' => 'required|min:2',
            'cust_phone' => 'required|min:10|max:10',
            'brand_name' => 'required|min:2',
            'model_name' => 'required|min:2',
            'fault' => 'required|max:255',
            'amount'=> 'required|min:1',
        ];
    }
}
