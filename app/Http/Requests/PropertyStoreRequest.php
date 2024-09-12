<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyStoreRequest extends FormRequest
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
            'owner_id' => ['integer', 'exists:owner,owner_id'],
            'loc_id' => ['integer', 'exists:location,loc_id'],
            'prop_description' => ['string', 'max:600'],
            'prop_rental_fee' => ['numeric', 'between:-999999.99,999999.99'],
            'prop_rental_deposit' => ['numeric', 'between:-999999.99,999999.99'],
            'prop_rental_negotiable' => ['in:yes,no'],
            'prop_rooms' => ['integer'],
            'prop_beds' => ['integer'],
            'prop_accommodation_type' => ['string', 'max:200'],
            'prop_rental_term' => ['string', 'max:200'],
        ];
    }
}
