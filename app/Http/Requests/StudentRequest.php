<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'name'=>'required|alpha',
            'class_id'=>'required',
            'birthday'=>'required|date-format:Y-m-d',
            'phone'=>'numeric'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Please enter name student!',
            'class_id.required'=>'Please choose class',
            'birthday.required'=>'Please enter birthday',
            'birthday.date-format'=>'Enter birthday following form yyyy/mm/dd'
        ];
    }
}
