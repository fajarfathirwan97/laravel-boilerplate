<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
                'uuid' => 'required|exists:roles,uuid'
            ];
        }elseif($this->isMethod('post')){
            $rule =  [
                'role.name' => 'required',
                'role.permissions' => 'required',
            ];    
        }
        return $rule;
    }
}
