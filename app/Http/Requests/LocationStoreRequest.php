<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationStoreRequest extends FormRequest
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
            'loc_order' => ['required', 'integer'],
            'loc_title' => ['required', 'string', 'max:200'],
            'loc_province' => ['required', 'string', 'max:200'],
        ];
    }
}
