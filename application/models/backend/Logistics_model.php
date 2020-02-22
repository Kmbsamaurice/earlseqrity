<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Logistics_model extends CI_Model{
        public function get_logistics($name = FALSE){
            if($name  === FALSE):
                $query =  $this->db->where('verify',1);;
                
        		$query  = $this->db->get('logistics');
        		return $query->result_array();
        	endif;
        	$query =  $this->db->get_where('logistics',array('name'=>$name));
        	return $query->row_array();
        }
        public function countlogistics(){
            $this->db->from('logistics');
            $this->db->where('verify','1');
            return $count = $this->db->count_all_results();
        }
    }