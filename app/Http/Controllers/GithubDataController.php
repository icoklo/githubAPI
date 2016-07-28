<?php

namespace App\Http\Controllers;

use App\GithubWebHooks;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GithubDataController extends Controller
{

	public function storeData(Request $request)
	{

		// if($request->header('X-Github-Event'))

		// ako je 'X-Hub-Signature' polje u zaglavlju http zahtjeva postavljeno
		// sto oznacava da se koristi polje secret koje sam postavil na githubu
		// a kak tocno provjeriti to secret polje jos ne znam :)
		if($request->header('X-Hub-Signature'))
		{
			// echo "jej";
			$event_name = $request->header('X-Github-Event');
			$payload = json_encode($request->all());

			/*
			$json =
			'{
				"country": { "full":"kontroler", "test":15 },
				"productId":1,
				"status":0,
				"opId":134
			}';

			// json_decode vraca array ako je drugi parametar true
			$citanjeJson = json_decode($json,true);
			$pomocArray = $citanjeJson['country']['full'];
			// echo $pomocArray;
			*/

			// help variable which contains payload from github which is in json format
			$help = json_decode($payload);

			$repository = $help->repository->full_name;
			// echo $repository;

			$web_hook = new GithubWebHooks;
			$web_hook->event_name= $event_name;
			// cijeli json od githuba
			$web_hook->payload = $payload;
			$web_hook->repository = $repository;
			$web_hook->save();

			$array = array('kod' => 200, 'poruka' => 'Uspjeh');
			return (new Response($array,200))->header('Content-Type', 'application/json');
		}
		else{
			$array = array('kod' => 400, 'poruka' => 'Desila se greska');
			return (new Response($array,400))->header('Content-Type', 'application/json');
		}

	}

}