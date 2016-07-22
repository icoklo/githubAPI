<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class GithubDataController extends Controller
{

	public function showData(Request $request)
    {
    	echo "tu smo";
    	$payload = $request->input('payload');
    	echo json_decode($request);

    }

}