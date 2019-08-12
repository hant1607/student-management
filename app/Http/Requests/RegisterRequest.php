<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        $arr_validate = [
            'name'=>'required',
            'class_id'=>'required',
            'phone'=>'required|numeric|unique:students,phone',
            'birthday'=>'required|date-format:Y-m-d',
            'username'=>'required',
            'level'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:4|max:10',
            'passwordAgain'=>'required|same:password'
        ];
        return $arr_validate;
    }
}