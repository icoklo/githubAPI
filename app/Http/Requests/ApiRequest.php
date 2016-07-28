<?php

namespace App\Http\Requests;

use Illuminate\Http\Request as BaseRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

// this class is used for my custom validation in laravel
abstract class ApiRequest
{

	public function __construct(){
		// echo "tu smo";

		// sve funkcije koje nasljeduju ovaj ApiRequest nasljeduju njegov konstruktor
		// a koliko sem skuzil ovaj $this->rules trazi funkciju rules u svoj djeci ove klase (sve klase koje nasljeduju ovu klasu)
		// i izvrsava odredenu funkciju rules u odredenoj klasi
		$validator = Validator::make(Request::all(), $this->rules(), $this->messages());
		$array = array();

		if($validator->fails())
		{
			// echo "tu";
			// tu se dobije polje zato jer svako polje moze imati vise gresaka
			foreach ($validator->messages()->getMessages() as $field_name => $messages) {
				foreach ($messages as $message) {
					$array[] = array('poruka' => $message);
					// echo $message . "<br/>";
				}
			}

		}
		// echo json$array;
		$this->printErrorMessages($array);
	}

	public function printErrorMessages($array)
	{
		// echo "Tu smo";
		// var_dump($array);
		if(count($array)!==0)
		{
			echo json_encode($array);
		}

		// nezz zast mi ova linija ispod ne radi!!!
		// return (new Response($array,200))->header('Content-Type', 'application/json');
	}

	abstract function rules();

	abstract function messages();
}