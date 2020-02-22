<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Customer_model extends CI_Model{
        public function get_customers($firstname = FALSE){
            if($firstname  === FALSE):
                $query =  $this->db->where('is_active',1);;
                
        		$query  = $this->db->get('customers');
        		return $query->result_array();
        	endif;
        	$query =  $this->db->get_where('customers',array('first_name'=>$firstname));
        	return $query->row_array();
        }
        public function countcustomers(){
            $this->db->from('customers');
            $this->db->where('is_active','1');
            return $count = $this->db->count_all_results();
        }
    }