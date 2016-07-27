<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{

	/**
     * Redirect route when errors occur.
     *
     * @var string
     */
    protected $redirectRoute = 'greske';

	protected function formatErrors(Validator $validator)
	{
		return $validator->errors()->all();
	}
}
