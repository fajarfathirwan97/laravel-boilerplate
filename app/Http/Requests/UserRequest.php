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
        $rule =  [
            "user.first_name"=>"required|max:20",
            "user.last_name"=>"required|max:20",
            "user.password"=>"required|max:20",
        ];
        if (!isNullAndEmpty($this->request->get('user')['id']))
            $rule = array_merge($rule,['user.current_password' => 'required|hashCheck']);
        return $rule;
    }
}
