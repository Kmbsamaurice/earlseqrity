<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Engineer_model extends CI_Model{
        public function get_engineers($name = FALSE){
            if($name  === FALSE):
                $query =  $this->db->where('verify',1);;
                
        		$query  = $this->db->get('engineers');
        		return $query->result_array();
        	endif;
        	$query =  $this->db->get_where('engineers',array('name'=>$name));
        	return $query->row_array();
        }
        public function countengineers(){
            $this->db->from('engineers');
            $this->db->where('verify','1');
            return $count = $this->db->count_all_results();
        }
    }