<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabelUpdateRequest extends FormRequest
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
            'label_name' => ['string', 'max:200'],
            'label_value' => ['string', 'max:200'],
            'label_icon' => ['string', 'max:200'],
        ];
    }
}
