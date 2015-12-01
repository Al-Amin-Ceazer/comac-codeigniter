<?php

class Message_Model extends CI_Model {




            public function add($info)
            {
                $this->db->insert('messages', $info);
            }

            public function sent_List()
            {
                $user_id = $this->session->userdata('user_id');
                $this->db->select('*');
                $this->db->from('messages');
                $this->db->where('from',$user_id);
                $this->db->order_by("id", "desc");
                $query_result = $this->db->get();
                $result = $query_result->result();
                return $result;
            }

            public function recieve_List()
            {
                $user_id = $this->session->userdata('user_id');
                $this->db->select('*');
                $this->db->from('messages');
                $this->db->where('to',$user_id);
                $this->db->order_by("id", "desc");
                $query_result = $this->db->get();
                $result = $query_result->result();
                return $result;
            }

            public function view_all_sent($id)
            {
                $this->db->select('*');
                $this->db->from('messages');
                $this->db->where('id',$id);
                $query_result = $this->db->get();
                $result = $query_result->row();
                return $result;
            }

            public function inbox_no()
            {
                $user_id = $this->session->userdata('user_id');
                $this->db->select('*');
                $this->db->from('messages');
                $this->db->where('to',$user_id);
                $this->db->where('read_status', 0);
                $query_result = $this->db->get();
                $result = $query_result->result();
                return $result;
            }

           /* public function deleteMessage($data)
            {
                    if (!empty($data)) {
                        $this->db->where_in('id', $data);
                        $this->db->delete('messages');
                    }
            }*/

            public function delete($ids)
            {
                $ids = $ids;
                foreach ($ids as $id)
                {
                    $did = intval($id).'<br>';
                    $this->db->where('id', $did);
                    $this->db->delete('messages');

                }

            }

            public function rec_mess()
            {
                $user_id = $this->session->userdata('user_id');
                $query =$this->db->query("select * from messages where messages.to='$user_id' order by id desc limit 10");
                $result = $query->result();
                return $result;
            }


            public function record_count()
            {
                $user_id = $this->session->userdata('user_id');
                $res =$this->db->query("select * from messages where messages.to='$user_id' ");
                return $res->num_rows();
            }

            public function fetch_inbox($limit, $start)
            {
                $user_id = $this->session->userdata('user_id');
                $query =$this->db->query("select * from messages where messages.to='$user_id' order by id desc limit $start, $limit ");

                if ($query->num_rows() > 0) {
                    return $query->result();
                }
                return false;
           }

           public function record_count_sent()
           {
                $user_id = $this->session->userdata('user_id');
                $res =$this->db->query("select * from messages where messages.from='$user_id' ");
                return $res->num_rows();
           }

            public function fetch_sentbox($limit, $start)
            {
                $user_id = $this->session->userdata('user_id');
                $query =$this->db->query("select * from messages where messages.from='$user_id' order by id desc limit $start, $limit ");

                if ($query->num_rows() > 0) {
                    return $query->result();
                }
                return false;
           }

}