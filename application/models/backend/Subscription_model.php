<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    class Subscription_model extends CI_Model{
        public function get_subscriptions($email = FALSE){
        	if($email  === FALSE):
        		$email  = $this->db->get('subscriptions');
        		return $query->result_array();
        	endif;
        	$query =  $this->db->get_where('subscriptions',array('email'=>$email));
        	return $query->row_array();
        }
        public function subscriptionList(){
            $this->db->select(array('s.id', 's.email','s.date_created'));
            $this->db->from('subscriptions s');
            $this->db->where('verify','1');  
            $this->db->order_by('s.id', 'DESC');     
            $query = $this->db->get();
            return $query->result_array();
        }
        public function countsubscriptions(){
            $this->db->from('subscriptions');
            $this->db->where('verify','1');
            return $count = $this->db->count_all_results();
        }
    }