<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class VisitStoreRequest extends FormRequest
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
            'Employee_id'     => ['required'],
            'supervisor_id'     => ['nullable'],
            'visit_type'     => ['nullable'],
            'visit_location'     => ['nullable'],
            'visitintime'     => ['required'],
            'visitouttime'     => ['required'],
            'HCPCS'     => ['required'],
            'Comment'     => ['nullable'],
            
        ];
    }
}
