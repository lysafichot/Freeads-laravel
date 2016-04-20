<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Redirect;
class Controller extends BaseController
{

	public function checkId($id) {
		$session = Session::get('auth');

		if($session->user_id !== $id) {
			Session::flash('authorized', "Not authorization");
			return Redirect::back();
		}
		return $session;
	}

}
