<?php

namespace App\Http\Requests;

use Illuminate\Http\Request as BaseRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class ApiRequest extends BaseRequest
{

	public function __construct(){
		// echo "tu smo";

		// sve funkcije koje nasljeduju ovaj ApiRequest nasljeduju njegov konstruktor
		// a koliko sem skuzil ovaj $this->rules trazi funkciju rules u svoj djeci ove klase (sve klase koje nasljeduju ovu klasu)
		// i izvrsava odredenu funkciju rules u odredenoj klasi
		$validator = Validator::make(Request::all(), $this->rules(), $this->messages);
		$array = array();

		if($validator->fails())
		{
			// echo "tu";
			// tu se dobije polje zato jer svako polje moze imati vise gresaka
			foreach ($validator->messages()->getMessages() as $field_name => $messages) {
				foreach ($messages as $message) {
					$array[] = array('kod' => 200, 'poruka' => $message);
					// echo $message . "<br/>";
				}
			}

		}
		// echo json$array;
		$this->printErrorMessages($array);
	}

	public function printErrorMessages($array)
	{
		return response()->json($array);
	}

}