<?php

class Sim_Card extends CI_Controller {

    private $_data = array();

    public function Sim_Card()
    {
        parent::__construct();

        if(isLogin('user_id')){

        }else
        {
            $this->session->unset_userdata('user_id');
            redirect('user/login');
        }

        $this->load->model('sim_model');
        $this->_data['title'] ="Sim Card";
        $this->_data['page_title'] = "Sim Card";
        $this->_data['menu'] = "sim_card";

    }
    public function index()
    {
        $this->load->library("pagination");
        $config["base_url"] = base_url() . "user/sim_card";
        $config["total_rows"] = $this->db->count_all("sim_card");
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
        $this->_data["simList"] = $this->sim_model->fetch_sim_card($config["per_page"], $page);
        $this->_data["links"] = $this->pagination->create_links();

        $this->_data['breadcrumb'] = 'sim_card';
        //$this->_data['simList'] = $this->sim_model->sim_LIst();
        $this->_data['view'] = 'sim_cardList';
        $this->load->view('user/home',$this->_data);
    }

    public function add()
    {
        if($_POST)
        {
            $this->form_validation->set_rules('sim_no','Sim No','required');
            $this->form_validation->set_rules('phone_no','Phone No','required');
            $this->form_validation->set_rules('carrier','Carrier','required');


            if($this->form_validation->run())
            {
                $info['sim_no'] = $_POST['sim_no'];
                $info['phone_no'] = $_POST['phone_no'];
                $info['carrier'] = $_POST['carrier'];
                $info['activated'] = $_POST['activated'];

                $this->db->insert('sim_card', $info);
                redirect('user/sim_card');
            }
        }

        $this->_data['breadcrumb'] = 'sim/add_sim';
        $this->_data['page_title'] = "Add Sim Card";
        $this->_data['view'] = 'sim_add';
        $this->load->view('user/home',$this->_data);
    }

    public function delete()
    {
        $id=$_POST['del_id'];
        $result=$this->sim_model->delete($id);
        return $result;
    }

    public function edit($id)
    {
        $this->_data['breadcrumb'] = "sim/edit";
        $this->_data['page_title'] = "Edit Sim Card";
        $this->_data['simdata'] = $this->db->get_where('sim_card', array('id' => $id))->row();
        //d($this->_data,1);
        $this->_data['view'] = 'sim_edit';
        $this->load->view('user/home',$this->_data);
    }

    public function update()
    {
        if($_POST)
        {
            $this->form_validation->set_rules('sim_no','Sim No','required');
            $this->form_validation->set_rules('phone_no','Phone No','required');
            $this->form_validation->set_rules('carrier','Carrier','required');


            if($this->form_validation->run())
            {
                $id = $this->input->post('id', true);
                $info['sim_no'] = $_POST['sim_no'];
                $info['phone_no'] = $_POST['phone_no'];
                $info['carrier'] = $_POST['carrier'];
                $info['activated'] = $_POST['activated'];

                $this->db->update('sim_card', $info, "id = $id");
                redirect('user/sim_card');
            }
        }
    }
}