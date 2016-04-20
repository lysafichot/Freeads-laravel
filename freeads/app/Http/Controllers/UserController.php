<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;

use DB;
use Validator;
use ValidatesRequest;
use Session;
use View;
use Hash;
use Redirect;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() // admin
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) // admin
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$user = User::checkId($id);
		return view('users.edit')->with(compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$user = User::checkId($id);

		$username = Input::get('username');
		$birthdate = Input::get('birthdate');
		$name = Input::get('name');
		$lastname = Input::get('lastname');

		$user = User::find($id);
		/*$user->fill($request->all());*/

		$user->username = $username ? $username : $user->username;
		$user->birthdate = $birthdate ? $birthdate : $user->birthdate;
		$user->name = $name ? $name : $user->name;
		$user->lastname = $lastname ? $lastname : $user->lastname;
		$user->save();

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$user = User::checkId($id);
		DB::table('users')->where('user_id', $id)->update(array('status' => 0));
		User::logout();
	}
}
