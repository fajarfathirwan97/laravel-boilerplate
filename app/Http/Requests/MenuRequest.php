<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
                'uuid' => 'required|exists:menus,uuid'
            ];
        }elseif($this->isMethod('post')){
            $rule =  [
                'menu.slug' => 'required',
                'menu.name' => 'required',
                'menu.icon' => 'required',
                'menu.href' => 'required',
                'menu.is_parent' => 'required',
            ];    
        }
        return $rule;
    }
}
