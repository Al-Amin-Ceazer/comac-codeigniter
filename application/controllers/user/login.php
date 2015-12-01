<?php

class Login extends CI_Controller{

	public function Login()
	{
		parent::__construct();

		$this->load->library(array('form_validation'));

		if(isLogin('user_id')) redirect('user/dashboard');
	}

	public function index()
	{
		if($_POST)
		{
			/*if($this->chk_user()) echo "yes";
			d($_POST, 1);*/
			$this->form_validation->set_rules('username','Username','required|trim');
			$this->form_validation->set_rules('password','Password','required|trim|callback_chk_user');

			if($this->form_validation->run() == true)
			{
				$user = $this->db->get_where('users',array('email' => $_POST['username']))->row();
				$info['user_id'] = $user->id;
				$info['type'] = $user->type;
				$info['user_name'] = $user->first_name." ".$user->last_name;
				$info['photo'] = $user->photo;

				$this->session->set_userdata($info);
				redirect('user/dashboard');
			}
		}

		$this->load->view('user/login');
	}

	public function chk_user()
	{
		$val = $this->db->get_where('users',array('email' => $_POST['username']))->row();
		$salt = $val->salt;
		$pass = hashPassword($_POST['password'],$salt);
		$user = $this->db->get_where('users',array('email' => $_POST['username'],'password' => $pass));

		if($user->num_rows() > 0)
		{
			$user = $user->row_array();
			$type = $user['type'];
			if($user['status'] != 'Y')
			{
				$this->form_validation->set_message('chk_user','Your account is not active');
				return false;
			}
			return true;
		}
		else
		{
			$this->form_validation->set_message('chk_user',"Invalid Email or Password");
			return false;
		}
	}
}