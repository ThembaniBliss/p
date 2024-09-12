<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OwnerStoreRequest extends FormRequest
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
            // 'user_id' => ['required', 'integer', 'exists:users,id'],
            'owner_name' => ['required', 'string', 'max:200'],            
            'owner_surname' => ['required', 'string', 'max:200'],
            'owner_address' => ['required', 'string', 'max:250'],
            // 'image' => ['required', 'string', 'max:200'],
        ];
    }
}
