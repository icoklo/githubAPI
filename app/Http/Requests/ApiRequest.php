<?php

namespace App\Http\Requests;

use Illuminate\Http\Request as BaseRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

// this class is used for my custom validation in laravel
abstract class ApiRequest extends BaseRequest
{

	// konstruktor ne smije vracati nikakve podatke kao odgovor, a pod time se podrazumijeva da on ne smije vracati nikakav response
	// ali moze baciti neki exception
	public function __construct(array $query = array(), array $request = array(), array $attributes = array(), array $cookies = array(), array $files = array(), array $server = array(), $content = null){

		parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

		$array = array();

		// sve funkcije koje nasljeduju ovaj ApiRequest nasljeduju njegov konstruktor
		// a koliko sem skuzil ovaj $this->rules trazi funkciju rules u svoj djeci ove klase (sve klase koje nasljeduju ovu klasu)
		// i izvrsava odredenu funkciju rules u odredenoj klasi
		$validator = Validator::make(Request::all(), $this->rules(), $this->messages());

		if($validator->fails())
		{
			// tu se dobije polje zato jer svako polje moze imati vise gresaka
			foreach ($validator->messages()->getMessages() as $field_name => $messages) {
				foreach ($messages as $message) {
					$array[] = array('poruka' => $message);
					// echo $message . "<br/>";
				}
			}

			throw new ValidationException($validator,$array);
		}
	}

	/* public function printError()
	{
		// zasto tu ispis ne radi nezz
		return response($this->array, $this->status)->header('Content-Type', 'application/json');
	} */

	abstract function authorize();

	abstract function rules();

	abstract function messages();
}