<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    //
	protected function formatErrors(Validator $validator)
	{
		return $validator->errors()->all();
	}
}
