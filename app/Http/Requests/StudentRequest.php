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
            'phone'=>'required|numeric|unique:students,phone',
            'gender'=>'required',
            'birthday'=>'required|date-format:Y-m-d',
            'image'=>'max:30000',
        ];
        if($this->request->has('username')) {
            $arr_validate = array_merge($arr_validate,[
                'username'=>'required|unique:users,username',
                'email'=>'required|email',
                'password'=>'required|min:4|max:10',
                'confirm_password'=>'required|same:password'
            ]);
        }
        if($this->student){
            $arr_validate['phone'] = 'required|numeric|unique:students,phone,'.$this->student;
        }
        if($this->request->get('id')) {
            $arr_validate['phone'] = 'required|numeric|unique:students,phone,'.$this->request->get('id');
        }
        return $arr_validate;
    }
    public function messages()
    {
        return [
            'image.max'=> __('The size of image must be under 30MB')
        ];
    }

}
