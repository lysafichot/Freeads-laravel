<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Validator;
use ValidatesRequest;
use Session;
use View;
use DB;
use Hash;
use Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;

class AuthController extends Controller
{
	protected $guard = 'admin';

	public function getRegister() {
		if (Session::has('auth')) {
			return redirect()->action('IndexController@showIndex');
		} else {
		return view('registration');
		}
	}
	public function postRegister(Request $request)
	{
		$validator = $this->validator($request->all());

		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}
		$user = $this->create($request->all());

		Mail::send('emails.confirm', ['id' => $user->id, 'token' => $user->token], function ($m) use ($user) {
			$m->to($user->email, $user->name)->subject('Your confirmation');
			$m->from('freeads@app.com', 'Freeads');
		});

		return $this->getRegister();
	}
	public function getConfirm($id, $token) {

		$user = DB::table('users')->where('user_id', $id)->where('token', $token)->where('status', 0)->first();

		if($user) {
			DB::table('users')->where('user_id', $id)->update(array('status' => 1));
			Session::put('auth', $user);
		}
		return redirect()->action('AuthController@getLogin');


	}
	public function postLogin(Request $request) {
		$log = $request->all();
		$user = DB::table('users')->where('username', $log['username'])->where('status', '>', 0)->first();
		if($user) {
			if(Hash::check($log['password'], $user->password)) {
				Session::put('auth', $user);
				return $this->getLogin();
			}
		} else {
			Session::flash('erreur', 'Les identifiants sont incorrects');
		}
		return view('login');
	}


	public function getLogin() {
		if(Session::has('auth')) {
			$session = Session::get('auth');
			$user = DB::table('users')->where('username', $session->username)->first();
			if($user) {
				return view('index')->with(compact('session'));
			}
		}
		return view('login');
	}

	protected function validator(array $data)
	{
		return Validator::make($data, [
		                     /*  'username' => 'required|max:20|unique:users',
		                     'password' => 'required|min:4',*/
		                      /* 'email' => 'required|email|max:255|unique:users',
		                       'name' => 'required|max:20|unique:users',
		                       'lastname' => 'required|max:20',
		                       'birthdate' => 'required|max:20',*/
		                       ]);
	}

	protected function create(array $data)
	{
		$token = str_random(60);
		$password = Hash::make($data['password']);
		return User::create([
		                    'username' => $data['username'],
		                    'password' => $password,
		                    'name' => $data['name'],
		                    'token' => $data['_token'],
		                    'lastname' =>$data['lastname'],
		                    'email' => $data['email'],
		                    'birthdate' => $data['birthdate'],
		                    ]);
	}
	public function postLogout() {
		return User::logout();
	}
}