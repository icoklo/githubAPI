<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\GroupRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

// pitanje: El je ovo dobro kak sem ja to mislil sloziti, znaci imam pogled i u njemu listu svih grupa, pa kad admin klikne na grupu
// onda mu se otvori novi pogled za uredivanje kliknute grupe (obicna forma) ili za pregled podataka te grupe (na stranici koja mi daje listu svih grupa napravim dva linka na te dvije opcije)
// ili da to drugacije slozim, ali problem je u tome sto svaki put moram
// provjeriti jeli prijavljeni korisnik admin, a ako radim zahtjev sa postmanom to morem jedino tak da svaki put u zahtjevu saljem username i pass
// i provjerim jeli user admin???

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
		echo "tu smo";
		$group = new Group;
		$group->name = $request->input('name');
		$group->description = $request->input('description');
		$group->save();
		$poruka = "Grupa ". $request->input('name') ." je unesena.";
		$polje = array('kod' => 200, 'poruka' => $poruka);
		return (new Response($polje,200))->header('Content-Type', 'application/json');
	}

	public function editGroup(GroupRequest $request,$id) // sloziti
	{
		$find_group = Group::findOrFail($id);

		$old_name = $find_group -> name;
		$old_description = $find_group -> description;

		$group->name = $request->input('name');
		$group->description = $request->input('description');
		$group->save();

		$poruka = "Uspjesno uredena grupa ". $request->input('name');
		$polje = array('kod' => 200, 'poruka' => $poruka);
		return (new Response($polje,200))->header('Content-Type', 'application/json');

	}

	public function listGroups() // sloziti
	{
		$find_group = Group::findOrFail($id);

		$old_name = $find_group -> name;
		$old_description = $find_group -> description;

		$group->name = $request->input('name');
		$group->description = $request->input('description');
		$group->save();

		$poruka = "Uspjesno uredena grupa ". $group->name = $request->input('name');
		$polje = array('kod' => 200, 'poruka' => $poruka);

	}
}