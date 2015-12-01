<?php

class Company_Model extends CI_Model {


            public function companyAll() {

                    $this->db->select('*');
                    $this->db->from('company');
                    $query_result = $this->db->get();
                    $result = $query_result->result();
                    return $result;
            }

            public function fetch_company($limit, $start)
            {
                $query = $this->db->query("select * from company order by id desc limit $start, $limit");

                if ($query->num_rows() > 0) {
                    return $query->result();
                }
                return false;
            }

            public function newCompany($info)
            {
                $this->db->insert('company', $info);
            }

            public function delete($id) {

                $this->db->where('id',$id);
                $this->db->delete('company');
            }

            public function companydata($id)
            {
                $this->db->select('*');
                $this->db->from('company');
                $this->db->where('id', $id);
                $query_result = $this->db->get();
                $result = $query_result->row();
                return $result;
            }

            public function updateCompany($info, $id)
            {
                $this->db->where('id', $id);
                $this->db->update('company', $info);
            }

           /* public function uploadLogo($info_ar, $id)
            {
                $this->db->where('id', $id);
                $this->db->insert('company', $info_ar);
            }*/

}