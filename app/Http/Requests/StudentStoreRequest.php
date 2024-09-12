<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
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
            'stud_name' => ['required', 'string', 'max:200'],
            'stud_surname' => ['required', 'string', 'max:200'],
            'stud_email' => ['string', 'max:200', 'email'],
            'stud_idnumber' => ['string', 'max:15'],
            'stud_phone' => ['string', 'max:12'],
            // 'image' => ['required', 'string'],
        ];
    }
}
