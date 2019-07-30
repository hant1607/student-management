<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassRequest extends FormRequest
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
            'name' =>'required',
            'faculty_id' => 'required'
        ];
        if(!$this->class) {
            $arr_validate['name'] = 'unique:classes,name';
        }
        return $arr_validate;
    }

}
