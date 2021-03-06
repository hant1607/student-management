<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
            'name' =>'required|unique:subjects,name'
        ];
        if($this->subject) {
            $arr_validate['name'] = 'required|unique:subjects,name,'.$this->subject;
        }
        return $arr_validate;
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter subject name',
            'name.unique' => 'This subject already exists'
        ];
    }
}
