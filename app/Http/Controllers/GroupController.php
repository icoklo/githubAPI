<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\GroupRequest;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
	public function insertGroup(GroupRequest $request)
	{
		$user_role = Auth::user()->role;
		if($user_role == 'admin'){

			$group = new Group;
			$group->name = $request->input('name');
			$group->description = $request->input('description');
			$group->save();
			$poruka = "Grupa ". $request->input('name') ."je unesena.";
			$polje = array('kod' => 200, 'poruka' => $poruka);
			return (new Response($polje,200))->header('Content-Type', 'application/json');
		}
		else{
			$poruka = "Samo administrator moze pristupiti ovoj stranici";
			$polje = array('kod' => 401, 'poruka' => $poruka);
			return (new Response($polje,401))->header('Content-Type', 'application/json');
		}
	}

	public function editGroup(GroupRequest $request,$id)
	{
		$user_role = Auth::user()->role;
		if($user_role == 'admin'){

			$find_group = Group::findOrFail($id);

			$old_name = $find_group -> name;
			$old_description = $find_group -> description;

			$group->name = $request->input('name');
			$group->description = $request->input('description');
			$group->save();

			$poruka = "Uspjesno uredena grupa ". $group->name = $request->input('name');
			$polje = array('kod' => 200, 'poruka' => $poruka);
			return (new Response($polje,200))->header('Content-Type', 'application/json');
		}
		else{
			$poruka = "Samo administrator moze pristupiti ovoj stranici";
			$polje = array('kod' => 401, 'poruka' => $poruka);
			return (new Response($polje,401))->header('Content-Type', 'application/json');
		}
	}
}