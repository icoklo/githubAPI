<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserGroupRequest extends ApiRequest
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
        return [
            //
            'groupName' => 'required',
        ];
    }

    public function messages()
    {
        return array
        (
            'required' => 'Polje :attribute je obavezno',
        );
    }


}
