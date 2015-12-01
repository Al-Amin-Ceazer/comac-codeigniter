<?php

class Sim_Model extends CI_Model {



            public function sim_LIst()
            {
                    $this->db->select('*');
                    $this->db->from('sim_card');
                    $this->db->order_by("id", "desc");
                    $query_result = $this->db->get();
                    $result = $query_result->result_array();
                    return $result;
            }

            public function delete($id)
            {
                $this->db->where('id',$id);
                $this->db->delete('sim_card');
            }

            public function fetch_sim_card($limit, $start)
            {
                $query = $this->db->query("select * from sim_card order by id desc limit $start, $limit");

                if ($query->num_rows() > 0) {
                    return $query->result_array();
                }
                return false;
            }
    }