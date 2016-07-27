<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\GroupRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class GroupController extends Controller
{

	public function test()
	{
		// abort(405,'greska');
		// return (new Response("<p>jej</p>"));
		//return response("<p>jej</p>");
		return new Response("Super");
	}

	public function createGroup(GroupRequest $request)
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

	// function for editing or for deleting group
	public function editDeleteGroup(GroupRequest $request,$id)
	{
		$find_group = Group::findOrFail($id);

		$delete_group = $request->input('delete');
		if($delete_group === 'yes'){
			$find_group->delete();
			$message = "Uspjesno izbrisana grupa";
			$array = array('kod' => 200, 'poruka' => $message);
			return (new Response($array,200))->header('Content-Type', 'application/json');
		}
		else
		{
			$old_name = $find_group->name;
			$find_group->name = $request->input('name');
			$find_group->description = $request->input('description');
			$find_group->save();

			$message = "Uspjesno uredena grupa";
			$array = array('kod' => 200, 'poruka' => $message);
			return (new Response($array,200))->header('Content-Type', 'application/json');
		}

	}

	/* public function showGroupData($id)
	{
		$find_group = Group::findOrFail($id);

		$array = array('id' => $find_group->id, 'name' => $find_group->name, 'description' => $find_group->description);
		return (new Response($array,200))->header('Content-Type', 'application/json');
	} */

	// function which will return all groups or empty array
	public function listGroups()
	{

		$groups = Group::all();
		$array = array();
		foreach ($groups as $group){
			$array[] = array('id' => $group->id, 'name' => $group->name, 'description' => $group->description);
		}

		return (new Response($array,200))->header('Content-Type', 'application/json');
	}

}