<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class VitalsStoreRequest extends FormRequest
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
            'Patient_id'     => ['required'],
            'form_id'     => ['nullable'],
            'BPLying'     => ['nullable'],
            'BPSitting'     => ['nullable'],
            'BPStanding'     => ['nullable'],
            'Temperature'     => ['nullable'],
            'Apical_Pulse'     => ['nullable'],
            'Radial_Pulse'     => ['nullable'],
            'Respirations'     => ['nullable'],
            'Weight'     => ['nullable'],
            'BPSide'     => ['nullable'],
            'OutofRange'     => ['nullable'],
            
        ];
    }
}
