<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
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
                'uuid' => 'required|exists:organizations,uuid'
            ];
        }elseif($this->isMethod('post')){
            $rule =  [
                'organizations.name' => 'required',
                'organizations.phone' => 'required|numeric|digits:10',
                'organizations.email' => 'required|email',
                'organizations.website' => 'required|regex:/^(http(s?):\/\/)?(www\.)+[a-zA-Z0-9\.\-\_]+(\.[a-zA-Z]{2,3})+(\/[a-zA-Z0-9\_\-\s\.\/\?\%\#\&\=]*)?$/'
            ];    
        }
        return $rule;
    }
}
