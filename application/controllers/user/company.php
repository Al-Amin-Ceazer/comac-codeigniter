<?php

class Company extends CI_Controller {

    private $_data = array();

    public function Company()
    {
        parent::__construct();

        if(isLogin('user_id')){

        }else
        {
            $this->session->unset_userdata('user_id');
            redirect('user/login');
        }

        $this->load->model('company_model');
        $this->load->library(array("resizeimage"));
        $this->_data['title'] ="Company";
        $this->_data['page_title'] = "Company";
        $this->_data['menu'] = "company";

    }
    public function index()
    {
        $this->load->library("pagination");
        $config["base_url"] = base_url() . "user/company";
        $config["total_rows"] = $this->db->count_all("company");
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
        $this->_data["companyAll"] = $this->company_model->fetch_company($config["per_page"], $page);
        $this->_data["links"] = $this->pagination->create_links();



        $this->_data['breadcrumb'] = 'company';
        //$this->_data['companyAll'] = $this->company_model->companyAll();
        $this->_data['view'] = 'companyList';
        $this->load->view('user/home',$this->_data);
    }

    public function add()
    {

        if($_POST)
        {
            $this->form_validation->set_rules('company_name','Company','required');
            $this->form_validation->set_rules('company_address','Address','required');
            $this->form_validation->set_rules('company_city','City','required');
            $this->form_validation->set_rules('company_state','State','required');
            $this->form_validation->set_rules('company_country','Country','required');
            $this->form_validation->set_rules('company_web','Web Site','required');


            if($this->form_validation->run())
            {
                $info['name'] = $_POST['company_name'];
                $info['address'] = $_POST['company_address'];
                $info['city'] = $_POST['company_city'];
                $info['state'] = $_POST['company_state'];
                $info['country'] = $_POST['company_country'];
                $info['web_site'] = $_POST['company_web'];


                if(isset($_FILES['logo']['name']) && !$_FILES['logo']['error'])
                {
                     $file_name = explode('.', $_FILES['logo']['name']);
                     $file_ext = $file_name[count($file_name)-1];
                     $file_ext = strtolower($file_ext);
                    if(in_array($file_ext, array('jpg','jpeg','png')))
                    {
                        $image_name = $_FILES['logo']['name'];
                        $upload = move_uploaded_file($_FILES['logo']['tmp_name'], ROOT_DIR.'/assets/uploads\images\company_logo\thumb'.$image_name);
                        $info['logo'] = $image_name;

                    }
                    else
                    {
                        $this->session->set_userdata('alert-type','danger');
                        $this->session->set_userdata('alert','File format not supported.');
                    }
                }

                $this->company_model->newCompany($info);
                redirect('user/company');
            }
        }

        $this->_data['breadcrumb'] = 'company/add_company';
        $this->_data['page_title'] = "Create Company";
        $this->_data['view'] = 'company_add';
        $this->load->view('user/home',$this->_data);
    }

    public function delete()
    {
        $id=$_POST['del_id'];
        $result=$this->company_model->delete($id);
        return $result;
    }

    public function edit($id)
    {
        $this->_data['breadcrumb'] = "company/edit";
        $this->_data['page_title'] = "Edit Company";
        $this->_data['companydata'] = $this->company_model->companydata($id);
        $this->_data['view'] = 'company_edit';
        $this->load->view('user/home',$this->_data);
    }

    public function update()
    {
        if($_POST)
        {
            $this->form_validation->set_rules('company_name','Company','required');
            $this->form_validation->set_rules('company_address','Address','required');
            $this->form_validation->set_rules('company_city','City','required');
            $this->form_validation->set_rules('company_state','State','required');
            $this->form_validation->set_rules('company_country','Country','required');
            $this->form_validation->set_rules('company_web','Web Site','required');

            if($this->form_validation->run())
            {
                $id = $this->input->post('id', true);
                $info['name'] = $_POST['company_name'];
                $info['address'] = $_POST['company_address'];
                $info['city'] = $_POST['company_city'];
                $info['state'] = $_POST['company_state'];
                $info['country'] = $_POST['company_country'];
                $info['web_site'] = $_POST['company_web'];


                if(isset($_FILES['logo']['name']) && !$_FILES['logo']['error'])
                {
                    $file_name = explode('.', $_FILES['logo']['name']);
                    $file_ext = $file_name[count($file_name)-1];
                    $file_ext = strtolower($file_ext);
                    if(in_array($file_ext, array('jpg','jpeg','png')))
                    {
                         $info['logo'] = $this->upload_image($id);

                         if($info['logo'] != '0')
                            $this->unlink_image($id);
                    }
                    else
                    {
                        $this->session->set_userdata('alert-type','danger');
                        $this->session->set_userdata('alert','File format not supported.');
                    }
                }

                $this->company_model->updateCompany($info, $id);

                redirect('user/company');
            }

        }
    }

    function upload_image($id)
    {
        $ext=strtolower(strstr($_FILES['logo']['name'],"."));
        $image_name = 'img_'.time()."_".$id.$ext;
        $path   = ROOT_DIR.'/assets/uploads/images/company_logo/'.$image_name;
        //$path = "D:\wamp\www\comac4\assets\uploads\images\user"

        $pathThumb  = ROOT_DIR.'/assets/uploads/images/company_logo/thumb/'.$image_name;
        $pathMedium = ROOT_DIR.'/assets/uploads/images/company_logo/medium/'.$image_name;
        //$pathLarge  = ROOT_DIR.'/assets/uploads/images/user/thumb/'.'img_'.$id.$ext;


        list($width, $height) = getimagesize($_FILES['logo']['tmp_name']);
        $this->resizeimage->imagePath = $path;
        if(move_uploaded_file($_FILES['logo']['tmp_name'], $path))
        {
            $mid_width = $width*(1/3);
            $mid_height = $height*(1/3);
            $resizeImage = $this->resizeimage->doResize($pathThumb,120,120,'','','','');
            $resizeImage = $this->resizeimage->doResize($pathMedium,$mid_width,$mid_height,'','','','');

            return $image_name;
        }

        return '0';

    }

    public function unlink_image($id)
    {
        $company = $this->db->get_where('company',array('id' => $id))->row_array();
        $image_name = $company['logo'];

        $ind = 0;
        $path[$ind++]   = ROOT_DIR.'/assets/uploads/images/company_logo/'.$image_name;
        $path[$ind++]   = ROOT_DIR.'/assets/uploads/images/company_logo/thumb/'.$image_name;
        $path[$ind++]   = ROOT_DIR.'/assets/uploads/images/company_logo/medium/'.$image_name;

        foreach ($path as $key => $value) {
            if(file_exists($value))
                 unlink($value);
        }
    }

}