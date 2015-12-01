<?php

class Message extends CI_Controller {

	private $_data = array();

	public function Message()
	{
		parent::__construct();

		if(isLogin('user_id')){

		}else
		{
			$this->session->unset_userdata('user_id');
			redirect('user/login');
		}

		$this->load->model('user_model');
		$this->load->model('message_model');
		$this->_data['title'] ="Message";
		$this->_data['page_title'] = "Message";
		$this->_data['page_subtitle'] = "user messages";
		$this->_data['menu'] = "message";

	}

	public function index()
	{
		$this->_data['breadcrumb'] = 'message/inbox';
		$this->_data['sent_message_number'] = $this->message_model->sent_List();
		$this->_data['receive_message_number'] = $this->message_model->inbox_no();
		$this->_data['view'] = 'message';

		$users =  $this->db->get('users')->result_array();
		$user_name = array();
		foreach ($users as $value) {
			$user_name[$value['id']] = $value['first_name']." ".$value['last_name'];
		}

		$this->_data['user_name'] = $user_name;

		        $this->load->library("pagination");
		        $config["base_url"] = base_url() . "user/message";
		        $config["total_rows"] = $this->message_model->record_count();
		        $config["per_page"] = 5;
		        $config["uri_segment"] = 3;
		        $choice = $config["total_rows"] / $config["per_page"];
		        $config["num_links"] = round($choice);
		        //$config["num_links"] = 2;

		        $config['full_tag_open'] = '<ul class="pagination">';
		        $config['full_tag_close'] = '</ul><!--pagination-->';

		        $config['first_link'] = FALSE;
		        $config['first_tag_open'] = '<li>';
		        $config['first_tag_close'] = '</li>';

		        $config['last_link'] = FALSE;
		        $config['last_tag_open'] = '<li>';
		        $config['last_tag_close'] = '</li>';

		        $config['next_link'] = '&rarr;';
		        $config['next_tag_open'] = '<li class="next page">';
		        $config['next_tag_close'] = '</li>';

		        $config['prev_link'] = '&larr;';
		        $config['prev_tag_open'] = '<li class="prev page">';
		        $config['prev_tag_close'] = '</li>';

		        $config['cur_tag_open'] = '<li class="active"><a href="">';
		        $config['cur_tag_close'] = '</a></li>';

		        $config['num_tag_open'] = '<li class="page">';
		        $config['num_tag_close'] = '</li>';

		        $this->pagination->initialize($config);

		        $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		        $this->_data['page'] = $page;
		        $this->_data["receive_message"] = $this->message_model->fetch_inbox($config["per_page"], $page);
		        $this->_data["links"] = $this->pagination->create_links();

		$this->_data['view'] = 'message_inbox';
        		$this->load->view('user/home',$this->_data);
	}

	public function add()
	{
		$type = $this->session->userdata('type');

		if($type == 'admin')
			{
				$super = $this->db->get_where('users',array('type' => 'superadmin'))->row_array();
				$info['to'] = $super['id'];
			}
		else
			$info['to'] = $_POST['to'];

	        $info['subject'] = $_POST['subject'];
	        $info['message'] = $_POST['message'];
	        $info['from'] = $_POST['from'];
	        $this->message_model->add($info);
	        $data['error'] = 0;
	        echo json_encode($data);

	}

	public function viewMessage_by_id($id, $page)
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
		$this->_data['page'] = $page;
		$this->_data['breadcrumb'] = 'message';
		$this->_data['view'] = 'message_view_inbox';
        		$this->load->view('user/home',$this->_data);

	}

	public function viewMessage_by_id_sentbox($id, $page)
	{
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
		$this->_data['page'] = $page;
		$this->_data['breadcrumb'] = 'message';
		$this->_data['view'] = 'message_view_sentbox';
        		$this->load->view('user/home',$this->_data);

	}

	public function remove()
	{
		$ids = ( explode( ',', $this->input->get_post('ids') ));
            	$this->message_model->delete($ids);
	}

	public function test()
	{
		$this->_data['view'] = 'test';
        		$this->load->view('user/home2',$this->_data);
        		//$this->load->view('user/home2');
	}

	public function create()
	{
		$this->_data['breadcrumb'] = 'message/create';
		$this->_data['sent_message_number'] = $this->message_model->sent_List();
		$this->_data['receive_message_number'] = $this->message_model->inbox_no();
		$this->_data['userList'] = $this->user_model->messageUserList();
		$this->_data['view'] = 'message_compose';
        		$this->load->view('user/home',$this->_data);
	}

	public function sentbox()
	{
		$this->_data['breadcrumb'] = 'message/sent';
		$this->_data['sent_message_number'] = $this->message_model->sent_List();
		$this->_data['receive_message_number'] = $this->message_model->inbox_no();
		$this->_data['view'] = 'message';

		$users =  $this->db->get('users')->result_array();
		$user_name = array();
		foreach ($users as $value) {
			$user_name[$value['id']] = $value['first_name']." ".$value['last_name'];
		}

		$this->_data['user_name'] = $user_name;

		        $this->load->library("pagination");
		        $config["base_url"] = base_url() . "user/message/sentbox";
		        $config["total_rows"] = $this->message_model->record_count_sent();
		        $config["per_page"] = 5;
		        $config["uri_segment"] = 4;
		        $choice = $config["total_rows"] / $config["per_page"];
		        $config["num_links"] = round($choice);
		        //$config["num_links"] = 2;

		        $config['full_tag_open'] = '<ul class="pagination">';
		        $config['full_tag_close'] = '</ul><!--pagination-->';

		        $config['first_link'] = FALSE;
		        $config['first_tag_open'] = '<li>';
		        $config['first_tag_close'] = '</li>';

		        $config['last_link'] = FALSE;
		        $config['last_tag_open'] = '<li>';
		        $config['last_tag_close'] = '</li>';

		        $config['next_link'] = '&rarr;';
		        $config['next_tag_open'] = '<li class="next page">';
		        $config['next_tag_close'] = '</li>';

		        $config['prev_link'] = '&larr;';
		        $config['prev_tag_open'] = '<li class="prev page">';
		        $config['prev_tag_close'] = '</li>';

		        $config['cur_tag_open'] = '<li class="active"><a href="">';
		        $config['cur_tag_close'] = '</a></li>';

		        $config['num_tag_open'] = '<li class="page">';
		        $config['num_tag_close'] = '</li>';

		        $this->pagination->initialize($config);

		        $page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		        $this->_data['page'] = $page;
		        $this->_data["sent_message"] = $this->message_model->fetch_sentbox($config["per_page"], $page);
		        $this->_data["links"] = $this->pagination->create_links();

		$this->_data['view'] = 'message_sentbox';
        		$this->load->view('user/home',$this->_data);
	}

}