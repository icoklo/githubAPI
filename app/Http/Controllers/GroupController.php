<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\GroupRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

// Sloziti da se pozove jedna funkcija u kojoj se bude napravil ispis podataka za korisnika
class GroupController extends Controller
{

	public function test()
	{

		// return (new Response("<p>jej</p>"));
		return response("<p>jej</p>");
	}

	public function createGroup(GroupRequest $request) // unos i spremanje grupe radi
	{
		// echo "tu smo";
		$group = new Group;
		$group->name = $request->input('name');
		$group->description = $request->input('description');
		$group->save();
		$message = "Grupa ". $request->input('name') ." je unesena.";
		$array = array('kod' => 200, 'poruka' => $message);
		return (new Response($array,200))->header('Content-Type', 'application/json');
	}

	public function editGroup(GroupRequest $request,$id)
	{
		$find_group = Group::findOrFail($id);

		$old_name = $find_group->name;
		$find_group->name = $request->input('name');
		$find_group->description = $request->input('description');
		$find_group->save();

		$message = "Uspjesno uredena grupa";
		$array = array('kod' => 200, 'poruka' => $message);
		return (new Response($array,200))->header('Content-Type', 'application/json');

	}

	public function showGroupData(GroupRequest $request,$id)
	{
		$find_group = Group::findOrFail($id);

		$array = array('id' => $find_group->id, 'name' => $find_group->name, 'description' => $find_group->description);
		return (new Response($array,200))->header('Content-Type', 'application/json');
	}

	public function listGroups() // sloziti
	{
		$groups = Group::all();
		$array = array();
		foreach ($groups as $group){
			$array[] = array('id' => $korisnik->id, 'Ime' => $korisnik->ime, 'Prezime' => $korisnik->prezime);
		}
		return (new Response($array,200))->header('Content-Type', 'application/json');
	}

}