<?php

use Laravel\Messages;

class Admin_Auth_Controller extends Admin_Base_Controller {

	public $meta_title = 'Authentication';

	public function get_login()
	{
		$this->layout->content = View::make('admin::auth.login');
	}

	public function put_login()
	{
		$auth = API::post(array('auth', 'login'), Input::all());
		if($auth->code == 400)
		{
			return Redirect::to(prefix('admin').'auth/login')->with('errors', new Messages($auth->get()))->with_input('except', array());
		}
	}

	public function get_logout()
	{
		Auth::logout();

		return Redirect::to(prefix('admin').'auth/login');
	}

}