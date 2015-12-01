<?php

class Device extends CI_Controller {

    private $_data = array();

    public function Device()
    {
        parent::__construct();

        if(isLogin('user_id')){

        }else
        {
            $this->session->unset_userdata('user_id');
            redirect('user/login');
        }

        $this->load->model('device_model');
        $this->_data['title'] ="Device";
        $this->_data['page_title'] = "Device";
        $this->_data['menu'] = "devices";
    }

    public function index()
    {
        $brands =  $this->db->get('brand')->result_array();
        $brand_name = array();

        foreach ($brands as $value) {
            $brand_name[$value['id']] = $value['brand_name'];
        }

        $models =  $this->db->get('models')->result_array();
        $model_name = array();

        foreach ($models as $value) {
            $model_name[$value['id']] = $value['model_name'];
        }

        $sim =  $this->db->get('sim_card')->result_array();
        $sim_no = array();

        foreach ($sim as $value) {
            $sim_no[$value['id']] = $value['sim_no'];
        }

        $color =  $this->db->get('color')->result_array();
        $color_no = array();

        foreach ($color as $value) {
            $color_no[$value['id']] = $value['color'];
        }

        $meterial =  $this->db->get('meterial')->result_array();
        $meterial_no = array();

        foreach ($meterial as $value) {
            $meterial_no[$value['id']] = $value['meterial'];
        }

        $this->_data['brand_name'] = $brand_name;
        $this->_data['model_name'] = $model_name;
        $this->_data['sim_no'] = $sim_no;
        $this->_data['meterial_no'] = $meterial_no;
        $this->_data['color_no'] = $color_no;

        $this->load->library("pagination");
        $config["base_url"] = base_url() . "user/device";
        $config["total_rows"] = $this->db->count_all("device");
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
        $device = $this->device_model->fetch_device($config["per_page"], $page);
        $this->_data["links"] = $this->pagination->create_links();

        $this->_data['page'] = $page;
        $this->_data["deviceList"] = $device;
        $this->_data['breadcrumb'] = 'device';
        $this->_data['view'] = 'device_list';
        $this->load->view('user/home',$this->_data);
    }

    public function add()
    {
        if($_POST)
        {
            //d($_POST,1);
            $this->form_validation->set_rules('brand','Brand','required');
            $this->form_validation->set_rules('model','Model','required');
            $this->form_validation->set_rules('serial_number','Serial Number','required');
            $this->form_validation->set_rules('IMEI_number','IMEI Number','required');
            $this->form_validation->set_rules('sim_card','Sim Card','required');
            $this->form_validation->set_rules('voltage','Voltage','required');
            $this->form_validation->set_rules('color','Color','required');
            $this->form_validation->set_rules('meterial','Meterial','required');


            if($this->form_validation->run())
            {
                $info['brand_id'] = $_POST['brand'];
                $info['model_id'] = $_POST['model'];
                $info['serial_number'] = $_POST['serial_number'];
                $info['IMEI_number'] = $_POST['IMEI_number'];
                $info['sim_card'] = $_POST['sim_card'];
                $info['voltage'] = $_POST['voltage'];
                $info['color'] = $_POST['color'];
                $info['meterial'] = $_POST['meterial'];
                $info['voice_activated'] = $_POST['voice_activated'];

                //d($info,1);

                $this->db->insert('device', $info);
                redirect('user/device');
            }
        }

        $this->_data['brandList'] =  $this->db->get('brand')->result();
        $this->_data['modelList'] =  $this->db->get('models')->result();
        $this->_data['simList'] =  $this->db->get('sim_card')->result();
        $this->_data['colorList'] =  $this->db->get('color')->result();
        $this->_data['materialList'] =  $this->db->get('meterial')->result();
        $this->_data['breadcrumb'] = 'device/add_device';
        $this->_data['page_title'] = "Create Device";
        $this->_data['view'] = 'device_add';
        $this->load->view('user/home',$this->_data);
        /*$this->_data['view'] = 'test';
        $this->load->view('user/home2',$this->_data);*/
    }

    public function delete()
    {
        $id=$_POST['del_id'];
        $result=$this->device_model->delete($id);
        return $result;
    }

    public function edit($id, $page)
    {
        $this->_data['breadcrumb'] = "device/edit";
        $this->_data['page_title'] = "Edit Device";
        $this->_data['brandList'] =  $this->db->get('brand')->result();
        $this->_data['modelList'] =  $this->db->get('models')->result();
        $this->_data['simList'] =  $this->db->get('sim_card')->result();
        $this->_data['colorList'] =  $this->db->get('color')->result();
        $this->_data['meterialList'] =  $this->db->get('meterial')->result();
        $this->_data['devicedata'] = $this->db->get_where('device', array('id' => $id))->row();
        $this->_data['page'] = $page;
        $this->_data['view'] = 'device_edit';
        $this->load->view('user/home',$this->_data);
    }

    public function update($page)
    {
        if($_POST)
        {
            $this->form_validation->set_rules('brand','Brand','required');
            $this->form_validation->set_rules('model','Model','required');
            $this->form_validation->set_rules('serial_number','Serial Number','required');
            $this->form_validation->set_rules('IMEI_number','IMEI Number','required');
            $this->form_validation->set_rules('sim_card','Sim Card','required');
            $this->form_validation->set_rules('voltage','Voltage','required');
            $this->form_validation->set_rules('color','Color','required');
            $this->form_validation->set_rules('meterial','Meterial','required');


            if($this->form_validation->run())
            {
                $id = $this->input->post('id', true);
                $info['brand_id'] = $_POST['brand'];
                $info['model_id'] = $_POST['model'];
                $info['serial_number'] = $_POST['serial_number'];
                $info['IMEI_number'] = $_POST['IMEI_number'];
                $info['sim_card'] = $_POST['sim_card'];
                $info['voltage'] = $_POST['voltage'];
                $info['color'] = $_POST['color'];
                $info['meterial'] = $_POST['meterial'];
                $info['voice_activated'] = $_POST['voice_activated'];

                $this->db->update('device', $info, "id = $id");
                redirect("user/device/$page");
            }
        }
    }

    public function view($id)
    {
        $this->_data['breadcrumb'] = "device/view";
        $this->_data['page_title'] = "View Device";
        $this->_data['page_title'] = "Device Details";

        $brands =  $this->db->get('brand')->result_array();
        $brand_name = array();

        foreach ($brands as $value) {
            $brand_name[$value['id']] = $value['brand_name'];
        }

        $models =  $this->db->get('models')->result_array();
        $model_name = array();

        foreach ($models as $value) {
            $model_name[$value['id']] = $value['model_name'];
        }

        $sim =  $this->db->get('sim_card')->result_array();
        $sim_no = array();

        foreach ($sim as $value) {
            $sim_no[$value['id']] = $value['sim_no'];
        }

        $color =  $this->db->get('color')->result_array();
        $color_no = array();

        foreach ($color as $value) {
                $color_no[$value['id']] = $value['color'];
        }

        $meterial =  $this->db->get('meterial')->result_array();
        $meterial_no = array();

        foreach ($meterial as $value) {
                $meterial_no[$value['id']] = $value['meterial'];
        }

        $this->_data['meterial_no'] = $meterial_no;
        $this->_data['color_no'] = $color_no;

        $this->_data['brand_name'] = $brand_name;
        $this->_data['model_name'] = $model_name;
        $this->_data['sim_no'] = $sim_no;

        $this->_data['devicedata'] = $this->db->get_where('device', array('id' => $id))->row();
        $this->_data['view'] = 'device_details';
        $this->load->view('user/home',$this->_data);
    }

}