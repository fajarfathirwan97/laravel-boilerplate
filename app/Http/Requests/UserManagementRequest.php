<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserManagementRequest extends FormRequest
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
        if($this->isMethod('delete')){
            $rule =  [ 
                'uuid' => 'required|exists:users,uuid'
            ];
        }elseif($this->isMethod('post')){
            $rule =  [
                'users.first_name' => 'required',
                'users.last_name' => 'required',
                'users.password' => 'required',
                'users.phone' => 'required|numeric|digits_between:9,13',
                'users.email' => 'required|email',
                'users.role' => 'required|exists:roles,id',
                'users.organization' => 'required|exists:organizations,id'
            ];    
        }
        return $rule;
    }
}
