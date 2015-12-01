<?php

class User extends CI_Controller {

    private $_data = array();

    public function User()
    {
        parent::__construct();

        if(isLogin('user_id')){

        }else
        {
            $this->session->unset_userdata('user_id');
            redirect('user/login');
        }

        $this->load->model('user_model');
        $this->_data['title'] ="User";
        $this->_data['type'] = $this->session->userdata('type');
        $this->_data['menu'] = "users";

    }
    public function index()
    {
        //echo $this->uri->segment(3);exit;
        $this->_data['breadcrumb'] = 'userList';
        $this->_data['page_title'] = "User List";

        $this->load->library("pagination");

        $config["base_url"] = base_url() . "user/user";
        $config["total_rows"] = $this->user_model->record_count();
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
        $this->_data["userList"] = $this->user_model->fetch_users($config["per_page"], $page);
        $this->_data["links"] = $this->pagination->create_links();
        $this->_data['page'] = $page;
        $this->_data['view'] = 'user_list';
        $this->load->view('user/home',$this->_data);
    }

    public function add()
    {
        if($_POST)
        {
            $this->form_validation->set_rules('first_name','First Name','trim|required|max_length[12]');
            $this->form_validation->set_rules('last_name','Last Name','trim|required|max_length[24]');
            $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password','Password','required|min_length[8]|matches[confirm_password]');
            $this->form_validation->set_rules('confirm_password','Confirm Password','required');
            $this->form_validation->set_rules('phone','Phone','required');
            $this->form_validation->set_rules('mobile','Mobile','required');
            $this->form_validation->set_rules('company','Company','required');
            $this->form_validation->set_rules('position','Position', 'required');
            $this->form_validation->set_message('is_unique', 'The %s is already exist');
            if($this->_data['type'] == 'superadmin')
                $this->form_validation->set_rules('type','Type', 'required');

            if($this->form_validation->run())
            {
                $info['first_name'] = $_POST['first_name'];
                $info['last_name'] = $_POST['last_name'];
                $info['email'] = $_POST['email'];
                $info['salt'] = $salt = salt();
                $info['password'] = hashPassword($_POST['password'],$salt);
                $info['phone'] = $_POST['phone'];
                $info['mobile'] = $_POST['mobile'];
                $info['company'] = $_POST['company'];
                $info['position'] = $_POST['position'];
                if($this->_data['type'] == 'superadmin')
                     $info['type'] = $_POST['type'];
                else
                    $info['type'] = 'user';

                $new_user_id = $this->user_model->newUser($info);

                $details['user_id'] = $new_user_id;
                $details['field'] = 'creator_id';
                $details['value'] = $this->session->userdata('user_id');

                $this->db->insert('user_details',$details);


                //$this->_send_email($info);
                redirect('user/user');
            }
        }

        $this->_data['breadcrumb'] = 'user/add_user';
        $this->_data['page_title'] = "Create User";
        $this->_data['companyList'] = $this->user_model->companyList();
        $this->_data['view'] = 'user_add';
        $this->load->view('user/home',$this->_data);
    }

    public function chk_email($email) {

        $email = $_POST['email'];
        $this->load->model('user_model');
        $result = $this->user_model->ck_mail($email);
        if(count($result) > 0) {
            echo 1;
        }
        else {
            echo 0;
        }
    }

    public function edit($id, $page)
    {
        $this->_data['breadcrumb'] = "user/edit";
        $this->_data['page_title'] = "Edit User";
        $this->_data['companyList'] = $this->db->get('company')->result();
        $this->_data['userdata'] = $this->db->get_where('users', array('id' => $id))->row();
        $this->_data['page'] = $page;
        $this->_data['view'] = 'user_edit';
        $this->load->view('user/home',$this->_data);
    }

    public function update($page)
    {
        if($_POST)
        {
            $this->form_validation->set_rules('first_name','First Name','trim|required|max_length[12]');
            $this->form_validation->set_rules('last_name','Last Name','trim|required|max_length[12]');
            $this->form_validation->set_rules('phone','Phone','required');
            $this->form_validation->set_rules('mobile','Mobile','required');
            $this->form_validation->set_rules('position','Position', 'required');
            $this->form_validation->set_rules('type','Type', 'required');

            if($this->form_validation->run())
            {
                $id = $this->input->post('id', true);
                $info['first_name'] = $_POST['first_name'];
                $info['last_name'] = $_POST['last_name'];
                $info['phone'] = $_POST['phone'];
                $info['mobile'] = $_POST['mobile'];
                $info['company'] = $_POST['company'];
                $info['position'] = $_POST['position'];
                $info['type'] = $_POST['type'];
                $this->user_model->updateUser($info, $id);
                redirect("user/user/$page");
            }
        }
    }

    public function delete()
    {
        $id=$_POST['del_id'];
        $result=$this->user_model->delete($id);
        return $result;
    }

    /*private function _send_email($info){

        $to = "consultant@fredand.co";//"consultant@fredand.co";
        $subject = 'New User Created';
        $message = "A new user created<br/> Name: ".$info['first_name']." ".$info['last_name']."<br/> Email: ".$info['email'];
        // To send HTML mail, the Content-type header must be set //id='.base64_encode($id).'
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Additional headers
        $headers .= 'From: COMAC <consultant@fredand.co>' . "\r\n";
        @mail($to,$subject,$message,$headers);
    }*/

}