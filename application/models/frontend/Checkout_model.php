<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Checkout_model extends CI_Model{
        public function save($data){
            $this->db->insert('shipping',$data);
            $shipping_id = $this->db->insert_id();
            return $shipping_id;            
        }
        public function savepayment($data){
            $this->db->insert('payment',$data);
            $payment_id = $this->db->insert_id();
            return $payment_id; 
        }
        public function saveorder($data){
            $this->db->insert('orders',$data);
            $payment_id = $this->db->insert_id();
            return $payment_id; 
        }
        public function saveorderdetails($data){
            $this->db->insert('order_details',$data);
            $payment_id = $this->db->insert_id();
            return $payment_id; 
        }
    }