<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMoreRequest extends FormRequest
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
            'subject_id.*' => 'required',
            'mark.*' => 'required|numeric|between:0,10'
        ];
    }

//    public function messages()
//    {
//        return [
//            'subject_id.*.required' => 'The subject field is required',
//            'mark.*.required' => 'The mark field is required',
//            'mark.*.numeric' => 'The mark field must be number',
//            'mark.*.between'=>'The mark field must be between 0 to 10'
//        ];
//    }
}
