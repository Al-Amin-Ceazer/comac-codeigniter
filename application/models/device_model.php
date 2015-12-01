<?php

class Device_Model extends CI_Model {



            public function deviceList()
            {
                    $this->db->select('*');
                    $this->db->from('device');
                    $this->db->order_by("id", "desc");
                    $this->db->limit(10);
                    $query_result = $this->db->get();
                    $result = $query_result->result();
                    return $result;
            }

            public function deviceAll()
            {
                    $this->db->select('*');
                    $this->db->from('device');
                    $query_result = $this->db->get();
                    $result = $query_result->result();
                    return $result;
            }

            public function delete($id)
            {
                $this->db->where('id',$id);
                $this->db->delete('device');
            }

            public function fetch_device($limit, $start)
            {
                $query = $this->db->query("select * from device order by id desc limit $start, $limit");

                if ($query->num_rows() > 0) {
                    return $query->result();
                }
                return false;
           }
    }