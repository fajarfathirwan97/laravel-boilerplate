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
        $rule =  [
            'menu.slug' => 'required',
            'menu.name' => 'required',
            'menu.icon' => 'required',
            'menu.href' => 'required',
            'menu.is_parent' => 'required',
        ];
        if (!isNullAndEmpty($this->request->get('user')['id']))
            $rule = array_merge($rule,['user.current_password' => 'required|hashCheck']);
        return $rule;
    }
}
