<?php

class Profile extends CI_Controller {

    private $_data = array();

    public function Profile()
    {
        parent::__construct();

        if(isLogin('user_id')){

        }else
        {
            $this->session->unset_userdata('user_id');
            redirect('user/login');
        }

        $this->load->model('user_model');
        $this->load->library(array("resizeimage"));
        $this->_data['title'] ="Profile";
        $this->_data['page_title'] = "Profile";
        $this->_data['menu'] = "profile";

    }

    public function index()
    {
        if($_POST)
        {
            $this->form_validation->set_rules('first_name','First Name','trim|required|max_length[12]');
            $this->form_validation->set_rules('last_name','Last Name','trim|required|max_length[12]');
            $this->form_validation->set_rules('phone','Phone','required');
            $this->form_validation->set_rules('mobile','Mobile','required');
            if($this->form_validation->run())
            {
                $id = $_POST['id'];
                $info['first_name'] = $_POST['first_name'];
                $info['last_name'] = $_POST['last_name'];
                $info['phone'] = $_POST['phone'];
                $info['mobile'] = $_POST['mobile'];
                $this->user_model->updateProfile($info, $id);

                if(isset($_FILES['photo']['name']) && !$_FILES['photo']['error'])
                {
                     $file_name = explode('.', $_FILES['photo']['name']);
                     $file_ext = $file_name[count($file_name)-1];
                     $file_ext = strtolower($file_ext);
                    if(in_array($file_ext, array('jpg','jpeg','png')))
                    {
                        /*$image_name = $id."_".$_FILES['photo']['name'];
                        $upload = move_uploaded_file($_FILES['photo']['tmp_name'], ROOT_DIR.'/assets/uploads/'.$image_name);*/
                        $info_ar['photo'] = $this->upload_image($id);
                     
                        if($info_ar['photo'] != '0')
                        {
                            $this->unlink_image($id);
                            $this->user_model->updateImage($id, $info_ar);
                        }
                         
                    }
                    else
                    {
                        $this->session->set_userdata('alert-type','danger');
                        $this->session->set_userdata('alert','File format not supported.');
                    }
                }
                redirect("user/profile/index/$id");
            }
        }

        $this->_data['breadcrumb'] = "user/profile";
        $this->_data['page_title'] = "Your Profile";
        $id = $this->session->userdata('user_id');
        $this->_data['companyList'] = $this->user_model->companyList();
        $this->_data['userdata'] = $this->user_model->userdata($id);
        $this->_data['view'] = 'user_profile';
        $this->load->view('user/home',$this->_data);
    }

    public function updatePassword()
    {
        $user_id = $this->session->userdata('user_id');
        $user = $this->db->get_where('users',array('id' => $user_id))->row_array();
        $current_password = $_POST['current_password'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $data = array();
        if(hashPassword($current_password, $user['salt']) == $user['password'])
        {
            if($password == $confirm_password)
            {
                $new_password = hashPassword($password, $user['salt']);
                $this->db->update('users',array('password' => $new_password),array('id' => $user_id));
                $data['error'] = 0;
            }
            else
            {
                $data['error'] = 1;
                $data['error_type'] = 'passwor_confirm_did_not_matched';
            }
        }
        else
        {
            $data['error'] = 1;
            $data['error_type'] = 'password_not_matched';
        }
        echo json_encode($data);
    }

    function upload_image($id)
    {
        $ext=strtolower(strstr($_FILES['photo']['name'],"."));
        $image_name = 'img_'.time()."_".$id.$ext;
        $path   = ROOT_DIR.'/assets/uploads/images/user/'.$image_name;
        //$path = "D:\wamp\www\comac4\assets\uploads\images\user"

        $pathThumb  = ROOT_DIR.'/assets/uploads/images/user/thumb/'.$image_name;
        $pathMedium = ROOT_DIR.'/assets/uploads/images/user/medium/'.$image_name;
        //$pathLarge  = ROOT_DIR.'/assets/uploads/images/user/thumb/'.'img_'.$id.$ext;
       
        list($width, $height) = getimagesize($_FILES['photo']['tmp_name']);
        $this->resizeimage->imagePath = $path;
        if(move_uploaded_file($_FILES['photo']['tmp_name'], $path))
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
        $user = $this->db->get_where('users',array('id' => $id))->row_array();
        $image_name = $user['photo'];
        $ind = 0;
        $path[$ind++] = ROOT_DIR.'/assets/uploads/images/user/'.$image_name;
        $path[$ind++] = ROOT_DIR.'/assets/uploads/images/user/thumb/'.$image_name;
        $path[$ind++] = ROOT_DIR.'/assets/uploads/images/user/medium/'.$image_name;

        foreach ($path as $key => $value) {
            if(file_exists($value))
                 unlink($value);
        }
    }
}