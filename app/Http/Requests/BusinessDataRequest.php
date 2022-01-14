<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessDataRequest extends FormRequest
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
            'search' => [
                'sometimes',
                'string',
            ],
            'offices' => [
                'sometimes',
                'numeric',
            ],
            'tables' => [
                'sometimes',
                'numeric',
            ],
            'square_meters.to' => [
                'required_with:square_meters.from',
                'numeric',
                'gt:square_meters.from',
            ],
            'square_meters.from' => [
                'required_with:square_meters.to',
                'numeric',
            ],
        ];
    }
}
