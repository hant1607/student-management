<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
        if($this->request->get('studentId')){
            $arr_validate = [
                'name'=>'required',
                'phone'=>'required|numeric|unique:students,phone,'.$this->request->get('studentId'),
                'birthday'=>'required|date-format:Y-m-d',
                'username'=>'required|unique:users,username,'.$this->request->get('userId'),
                'image'=>'max:30000'
            ];
            return $arr_validate;
        }
        $arr_validate = [
            'username'=>'required'
        ];
        return $arr_validate;
    }
}
