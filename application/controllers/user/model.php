<?php

class Model extends CI_Controller {

    private $_data = array();

    public function Model()
    {
        parent::__construct();

        if(isLogin('user_id')){

        }else
        {
            $this->session->unset_userdata('user_id');
            redirect('user/login');
        }

        $this->load->model('models_model');
        $this->_data['title'] ="Models";
        $this->_data['page_title'] = "Models";
        $this->_data['menu'] = "models";

    }
    public function index()
    {
        $brands =  $this->db->get('brand')->result_array();
        $brand_name = array();

        foreach ($brands as $value) {
            $brand_name[$value['id']] = $value['brand_name'];
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
        $this->_data['color_no'] = $color_no;

        $this->load->library("pagination");
        $config["base_url"] = base_url() . "user/model";
        $config["total_rows"] = $this->db->count_all("models");
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);

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
        $model = $this->models_model->fetch_modelList($config["per_page"], $page);
        $this->_data["links"] = $this->pagination->create_links();

        $cnt = 0;
        foreach ($model as $key => $value) {
            $color_ar = unserialize($value[color_id]);
            $temp = '';
            foreach ($color_ar as $color_id) {
              $temp .= ', '.$color_no[$color_id];
            }
            $temp = ltrim($temp, ', ');
            $model[$cnt][color] = $temp;
            $cnt++;
        }

        $mcnt = 0;
        foreach ($model as $key => $value) {
            $meterial_ar = unserialize($value[meterial_id]);
            $temp = '';
            foreach ($meterial_ar as $meterial_id) {
              $temp .= ', '.$meterial_no[$meterial_id];
            }
            $temp = ltrim($temp, ', ');
            $model[$mcnt][meterial] = $temp;
            $mcnt++;
        }

        $this->_data["modelList"] = $model;
        $this->_data['breadcrumb'] = 'model';
        $this->_data['view'] = 'model_list';
        $this->load->view('user/home',$this->_data);
    }

    public function add()
    {
        if($_POST)
        {
            $this->form_validation->set_rules('brand','Brand','required');
            $this->form_validation->set_rules('model','Model','required');

            if($this->form_validation->run())
            {
                $info['brand_id'] = $_POST['brand'];
                $info['model_name'] = $_POST['model'];
                $info['color_id'] = serialize($_POST[color]);
                $info['meterial_id'] = serialize($_POST[meterial]);

                $this->db->insert('models', $info);
                redirect('user/model');
            }
        }

        $this->_data['brandList'] =  $this->db->get('brand')->result();
        $this->_data['simList'] =  $this->db->get('sim_card')->result();
        $this->_data['colorList'] =  $this->db->get('color')->result();
        $this->_data['materialList'] =  $this->db->get('meterial')->result();
        $this->_data['breadcrumb'] = 'model/add_model';
        $this->_data['page_title'] = "Add Model";
        $this->_data['view'] = 'model_add';
        $this->load->view('user/home2',$this->_data);
    }

    public function delete()
    {
        $id=$_POST['del_id'];
        $result=$this->models_model->delete($id);
        return $result;
    }

    public function edit($id)
    {
        $this->_data['breadcrumb'] = "model/edit";
        $this->_data['page_title'] = "Edit Model";
        $brands =  $this->db->get('brand')->result_array();
        $brand_name = array();

        foreach ($brands as $value) {
            $brand_name[$value['id']] = $value['brand_name'];
        }

        $Model = $this->db->get_where('models', array('id' => $id))->row_array();
        //d($Model,1);
        $this->_data['brandList'] =  $this->db->get('brand')->result();
        $this->_data['colorList'] =  $this->db->get('color')->result();
        $this->_data['meterialList'] =  $this->db->get('meterial')->result();
        $this->_data['color_ar'] = unserialize($Model[color_id]);
        $this->_data['meterial_ar'] = unserialize($Model[meterial_id]);
        $this->_data['modeldata'] = $Model;
        $this->_data['view'] = 'model_edit';
        $this->load->view('user/home2',$this->_data);
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