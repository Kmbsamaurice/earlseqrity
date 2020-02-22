<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    class Message_model extends CI_Model{
        public function get_messages($email = FALSE){
        	if($email  === FALSE):
        		$email  = $this->db->get('messages');
        		return $query->result_array();
        	endif;
        	$query =  $this->db->get_where('messages',array('email'=>$email));
        	return $query->row_array();
        }
        public function messageList(){
            $this->db->select(array('m.id', 'm.name', 'm.subject', 'm.email', 'm.message', 'm.phone','m.date_created'));
            $this->db->from('messages m');
            $this->db->order_by('m.id', 'DESC');     
            $query = $this->db->get();
            return $query->result_array();
        }
        public function getmessage($id){
            $this->db->from('messages');
            $this->db->where('id', $id);
            $result = $this->db->get('');
            
            if ($result->num_rows() > 0) {
              return $result->row();
            }
        }
        public function deletemessage($id){
            $this->db->where('id',$id);
            $this->db->delete('messages',array('id'=>$id));
            return TRUE;
        }
        public function countmessages(){
            $this->db->from('messages');
            return $count = $this->db->count_all_results();
        }
    }