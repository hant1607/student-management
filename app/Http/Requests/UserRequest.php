<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'username'=>'required|unique:users,username',
            'level'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:4',
            'passwordAgain'=>'required|same:password'
        ];
        if($this->user){
            $arr_validate['username'] = 'unique:users,username,'.$this->user;
        }
        return $arr_validate;
    }
}
