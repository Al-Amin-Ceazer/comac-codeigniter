<?php

class Models_Model extends CI_Model {


            public function delete($id)
            {
                $this->db->where('id',$id);
                $this->db->delete('models');
            }

            public function fetch_modelList($limit, $start)
            {
                $query = $this->db->query("select * from models order by id desc limit $start, $limit");

                if ($query->num_rows() > 0) {
                    return $query->result_array();
                }
                return false;
            }
    }