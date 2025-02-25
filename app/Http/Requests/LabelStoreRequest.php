<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabelStoreRequest extends FormRequest
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
            'label_name' => ['required', 'string', 'max:200'],
            'label_value' => ['required', 'string', 'max:200'],
            'label_icon' => ['required', 'string', 'max:200'],
        ];
    }
}
