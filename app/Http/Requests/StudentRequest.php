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
        $arr_validate = [
            'name'=>'required',
            'class_id'=>'required',
            'phone'=>'required|numeric',
            'birthday'=>'required|date-format:Y-m-d',
        ];
        if($this->request->has('username')) {
            $arr_validate = array_merge($arr_validate,[
                'username'=>'required',
                'level'=>'required',
                'email'=>'required|email',
                'phone'=>'required|numeric',
                'password'=>'required|min:4|max:10',
                'passwordAgain'=>'required|same:password'
            ]);
        }
        if(!$this->student){
            $arr_validate['phone'] = 'unique:students,phone';
        }
        return $arr_validate;
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
