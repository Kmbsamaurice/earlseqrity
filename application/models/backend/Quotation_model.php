<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    class Quotation_model extends CI_Model{
        public function get_quotation($email = FALSE){
        	if($email  === FALSE):
        		$email  = $this->db->get('quotations');
        		return $query->result_array();
        	endif;
        	$query =  $this->db->get_where('quotations',array('email'=>$email));
        	return $query->row_array();
        }
        public function quotationList(){
            $this->db->select(array('q.id', 'q.name', 'q.project', 'q.email', 'q.details', 'q.phone','q.date_created'));
            $this->db->from('quotations q');
            $this->db->order_by('q.id', 'DESC');     
            $query = $this->db->get();
            return $query->result_array();
        }
        public function getquotation($id){
            $this->db->from('quotations');
            $this->db->where('id', $id);
            $result = $this->db->get('');
            
            if ($result->num_rows() > 0) {
              return $result->row();
            }
        }
        public function deletequotation($id){
            $this->db->where('id',$id);
            $this->db->delete('quotations',array('id'=>$id));
            return TRUE;
        }
        public function countquotations(){
            $this->db->from('quotations');
            return $count = $this->db->count_all_results();
        }
    }