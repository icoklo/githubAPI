<?php 

namespace App\Http\Requests;

class CreateUserRequest extends ApiRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		// return false;
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
			'username' => 'required|email',
			'password' => 'required',
			'email' => 'required',
			'role' => 'required',
		];
	}

	public function messages()
    {
        return array
        (
            'required' => 'Polje :attribute je obavezno',
            'email' => 'U polju :attribute se ocekuje mail, pa bi trebali unijeti @ znak u to polje'
        );
    }

}