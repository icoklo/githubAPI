<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class GithubDataController extends Controller
{

	public function storeData(Request $request)
	{

		$event_name = $request->header('X-Github-Event');
		$payload = json_encode($request->all());

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

		$help = json_decode($payload);
		$repository = $help->repository->full_name;
		// echo $repository;

		$web_hook = new Github_webhooks;
		$web_hook->event_name= $event_name;
		// cijeli json od githuba 
		$web_hook->payload = $payload;
		$web_hook->repository = $repository;
		$web_hook->save();

		$polje = array('kod' => 200, 'poruka' => 'Uspjeh');
		return (new Response($polje,200))->header('Content-Type', 'application/json');
	}

}