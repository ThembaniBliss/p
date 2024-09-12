<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryUpdateRequest extends FormRequest
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
            'image_id' => ['required', 'integer', 'exists:images,id'],
            'property_id' => ['required', 'integer', 'exists:properties,id'],
            'main' => ['required', 'string', 'max:200'],
        ];
    }
}
