<?php

namespace App\Http\Requests;

// use App\Http\Requests\ApiRequest;
use Illuminate\Support\Facades\Auth;

class GroupRequest extends ApiRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /*
        if (Auth::user()->role == 'admin'){
            return true;
        }
        return false; */
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        // echo "rules:".$this->status;
        // echo __FUNCTION__ ;
        return
        [
            'name' => 'required',
            'description' => 'required',
            'delete' => 'required',
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