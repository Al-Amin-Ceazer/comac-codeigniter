<?php

class Logout extends CI_Controller{

	public function Logout()
	{
		parent::__construct();

		if(!isLogin()) redirect('user/login');
	}
	public function index()
	{
		$this->session->sess_destroy();
		redirect('user/login');
	}
}
