<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Seller_model extends CI_Model{
        public function get_sellers($name = FALSE){
            if($name  === FALSE):
                $query =  $this->db->where('verify',1);;
                
        		$query  = $this->db->get('sellers');
        		return $query->result_array();
        	endif;
        	$query =  $this->db->get_where('sellers',array('name'=>$name));
        	return $query->row_array();
        }
        public function countsellers(){
            $this->db->from('sellers');
            $this->db->where('verify','1');
            return $count = $this->db->count_all_results();
        }
    }