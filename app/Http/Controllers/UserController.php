<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\UserGroupRequest;
use App\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
	public function listUsers()
	{
		$users = User::all();
		$array = array();
		foreach ($users as $user){
			$array[] = array('id' => $user->id, 'username' => $user->username, 'email' => $user->email, 'role' => $user->role);
		}
		return (new Response($array,200))->header('Content-Type', 'application/json');
	}

	public function addUserToGroup(UserGroupRequest $request,$idKorisnika)
	{
		$group_name = $request->input('groupName');
		$user = User::findOrFail($idKorisnika);
		$array = array();
		$group = Group::where('name',$group_name)->first();
		$group_id = $group->id;
		// echo $group->id;
		echo $group_id;
		// $user->groups()->attach($group->id);

		$message = "Korisnik {$user->username} dodan u grupu {$group->name} .";
		$array = array('kod'=>200, 'poruka'=>$message);
		return (new Response($array,200))->header('Content-Type', 'application/json');
	}
}