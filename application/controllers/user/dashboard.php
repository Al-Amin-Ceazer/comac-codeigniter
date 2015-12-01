<?php

class Dashboard extends CI_Controller {

	private $_data = array();

	public function Dashboard()
	{
		parent::__construct();

		if(isLogin('user_id')){

		}else
		{
			$this->session->unset_userdata('user_id');
			redirect('user/login');
		}

		$this->load->model('message_model');
		$this->load->model('device_model');
		$this->_data['title'] ="Dashboard";
		$this->_data['page_title'] = "Dashboard";
		$this->_data['menu'] = "dashboard";

	}
	public function index()
	{
		$user_id = $this->session->userdata('user_id');
		$type = $this->session->userdata('type');
		if($type == 'superadmin')
			$users = $this->db->get('users')->result_array();
		else
			$users = $this->db->query("select users.* from users,user_details where users.id = user_details.user_id and user_details.field = 'creator_id' and user_details.value = $user_id")->result_array();

		$messages = $this->db->get_where('messages',array('to' => $user_id))->result_array();
		$this->_data['user_count'] = number_format(count($users));
		$this->_data['message_count'] = number_format(count($messages));
		$this->_data['device_count'] = number_format(count($this->device_model->deviceAll()));
		$this->_data['deviceList'] = $this->device_model->deviceList();
		$this->_data['receive_message'] = $query = $this->message_model->rec_mess();
		$users =  $this->db->get('users')->result_array();
		$user_name = array();
		foreach ($users as $value) {
			$user_name[$value['id']] = $value['first_name']." ".$value['last_name'];
		}

		$this->_data['user_name'] = $user_name;

		$this->_data['breadcrumb'] = 'dashboard';
		$this->_data['view'] = 'dashboard';
		$this->load->view('user/home',$this->_data);
	}

	public function viewMessage_by_id($id)
	{
		$this->db->update('messages', array('read_status' => 1), array('id' => $id));
		$message = $this->db->get_where('messages', array('id' => $id))->row_array();
		$user = $this->db->get_where('users',array('id' => $message['from']))->row_array();
		$user_to = $this->db->get_where('users',array('id' => $message['to']))->row_array();
		$img = $user['photo'] != ''?$user['photo']:'avatar.png';

		$this->_data['messageData'] = $this->message_model->view_all_sent($id);
		$this->_data['sender_name'] = ucfirst($user['first_name'])." ".$user['last_name'];
		$this->_data['recever_name'] = ucfirst($user_to['first_name'])." ".$user_to['last_name'];
		$this->_data['sender_email'] = $user['email'];
		$this->_data['send_time'] = date("h:ia jS M Y",strtotime($message['time']));
		$this->_data['profile_image'] = base_url("assets/uploads/images/user/thumb/$img");
		$this->_data['breadcrumb'] = 'message';
		$this->_data['view'] = 'message_view_dashboard';
        		$this->load->view('user/home',$this->_data);

	}

}