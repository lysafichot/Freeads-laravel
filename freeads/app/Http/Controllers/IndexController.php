<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{

	public function showIndex() {
		return view('index');
	}
}
