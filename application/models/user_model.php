<?php

class User_Model extends CI_Model {


            public function ck_mail($email) {

                    $this->db->select('*');
                    $this->db->from('users');
                    $this->db->where('email', $email);
                    $query_result = $this->db->get();
                    $result = $query_result->row();
                    return $result;
            }

            public function record_count() {
                $user_id = $this->session->userdata('user_id');
                if($this->session->userdata('type') == 'superadmin')
                    $res = $this->db->query("select * from users where type = 'user' or type = 'admin'");
                else if($this->session->userdata('type') == 'admin')
                    $res = $this->db->query("select users.* from users,user_details where users.id = user_details.user_id and user_details.field = 'creator_id' and user_details.value = $user_id");
                return $res->num_rows();
            }

            public function fetch_users($limit, $start) {

                $user_id = $this->session->userdata('user_id');
                if($this->session->userdata('type') == 'superadmin')
                    $query = $this->db->query("select * from users where type = 'user' or type = 'admin' order by id desc limit $start, $limit");
                else if($this->session->userdata('type') == 'admin')
                    $query = $this->db->query("select users.* from users,user_details where users.id = user_details.user_id and user_details.field = 'creator_id' and user_details.value = $user_id order by id desc limit $start, $limit");

                if ($query->num_rows() > 0) {
                    return $query->result();
                }
                return false;
            }

            public function companyList()
            {
                    $this->db->select('*');
                    $this->db->from('company');
                    $query_result = $this->db->get();
                    $result = $query_result->result();
                    return $result;
            }

            public function newUser($info)
            {
                $this->db->insert('users', $info);
                return $this->db->insert_id();
            }

            public function userList()
            {
                $user_id = $this->session->userdata('user_id');

                if($this->session->userdata('type') == 'superadmin')
                {
                    $this->db->select('*');
                    $this->db->from('users');
                    $this->db->where('type','user');
                    $this->db->or_where('type','admin');
                    $query_result = $this->db->get();
                    $result = $query_result->result();
                }
                else if($this->session->userdata('type') == 'admin')
                {
                   $result = $this->db->query("select users.* from users,user_details where users.id = user_details.user_id and user_details.field = 'creator_id' and user_details.value = $user_id")->result();
                }

                return $result;
            }

            public function messageUserList()
            {
                $user_id = $this->session->userdata('user_id');

                if($this->session->userdata('type') == 'superadmin')
                {
                    $this->db->select('*');
                    $this->db->from('users');
                    $this->db->where('type','user');
                    $this->db->or_where('type','admin');
                    $query_result = $this->db->get();
                    $result = $query_result->result();
                }
                else if($this->session->userdata('type') == 'user')
                {
                    $this->db->select('*');
                    $this->db->from('users');
                    $this->db->where('type','admin');
                    $query_result = $this->db->get();
                    $result = $query_result->result();
                }

                return $result;
            }

            public function userdata($id)
            {
                $this->db->select('*');
                $this->db->from('users');
                $this->db->where('id', $id);
                $query_result = $this->db->get();
                $result = $query_result->row();
                return $result;
            }

            public function updateUser($info, $id)
            {
                $this->db->where('id', $id);
                $this->db->update('users', $info);
            }

            public function delete($id) {

                $this->db->where('id',$id);
                $this->db->delete('users');
            }

            public function updateProfile($info, $id)
            {
                $this->db->where('id', $id);
                $this->db->update('users', $info);
            }

            public function updateImage($id, $info_ar)
            {
                $this->db->where('id',$id);
                $this->db->update('users',$info_ar);
            }

}
?>