<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\UserGroupRequest;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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

		// dohvacanje grupe prema imenu grupe, dohvaca se prvi model koji zadovoljava upit
		$group = Group::where('name',$group_name)->first();

		// ovako se radi spremanje u pivot tablicu user_group kod veze vise-vise 
		$user->groups()->attach($group->id);

		$message = "Korisnik {$user->username} dodan u grupu {$group->name} .";
		$array = array('kod'=>200, 'poruka'=>$message);
		return (new Response($array,200))->header('Content-Type', 'application/json');
	}

	public function userGroups()
	{
		$logged_user = Auth::user();
		$groups = $logged_user->groups()->get();
		$array = array();
		foreach ($groups as $group) {
			$array[] = array('id' => $group->id,'name' => $group->name, 'description' => $group->description);
		}
		return (new Response($array,200))->header('Content-Type', 'application/json');
	}
}