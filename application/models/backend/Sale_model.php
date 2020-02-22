<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Sale_model extends CI_Model{
        public function get_consultants($name = FALSE){
            if($name  === FALSE):
                $query =  $this->db->where('verify',1);;
                
        		$query  = $this->db->get('sales');
        		return $query->result_array();
        	endif;
        	$query =  $this->db->get_where('sales',array('name'=>$name));
        	return $query->row_array();
        }
        public function countlogistics(){
            $this->db->from('sales');
            $this->db->where('verify','1');
            return $count = $this->db->count_all_results();
        }
    }