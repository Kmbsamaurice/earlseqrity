<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Order_model extends CI_Model{
        public function orders(){
            return $this->db->select('*')
                    ->from('orders')
                    ->order_by('order_id', 'DESC')
                    ->join('customers','customers.id = orders.customer_id')
                    ->join('shipping','shipping.shipping_id = orders.shipping_id')
                    ->join('payment','payment.payment_id = orders.payment_id')
                    ->get()
                    ->result();
        }
        public function ordered(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();

            $customer_id =$data['customer']['id'];
            $this->db->select('*');
            $this->db->from('orders');
            $this->db->join('customers','customers.id = orders.customer_id');
            $this->db->join('order_details','order_details.order_id = orders.order_id');
    
            $this->db->where('orders.customer_id', $customer_id);
            $this->db->order_by('orders.order_id', 'DESC');
            $query = $this->db->get();
            return $query->result_array();
        }
        //get particular orders for the my orders in the frontend
        public function customer_order(){
            $customer_id = $this->session->userdata('id');
            return $this->db->select('*')
                    ->from('orders','order_details')
                    ->join('customers','customers.id = orders.customer_id')
                    ->join('shipping','shipping.shipping_id = orders.shipping_id')
                    ->join('payment','payment.payment_id = orders.payment_id')
                    ->join('order_details','order_details.order_id = orders.order_id')
                    ->join('products','products.id = order_details.product_id')
                    ->where('orders.customer_id',$customer_id)
                    ->get()
                    ->result();
        }
        public function orderdetails($order_id){
            return $this->db->select('*')
                    ->from('order_details')
                    ->where('order_id',$order_id)
                    ->get()
                    ->result();
        }
        //count the number of orders in the table orders
        public function countorders(){
            $this->db->from('orders');
            return $count = $this->db->count_all_results();
        }
        public function orderdetails_id($order_id){
            return $this->db->select('*')
                   ->from('orders')
                   ->where('order_id',$order_id)
                   ->get()
                   ->row();
       }
       public function customerdetails_id($customer_id){
        return $this->db->select('*')
                ->from('customers')
                ->where('id',$customer_id)
                ->get()
                ->row();
    }
    public function shippingdetails_id($shipping_id){
        return $this->db->select('*')
                ->from('shipping')
                ->where('shipping_id',$shipping_id)
                ->get()
                ->row();
    }
    public function orderdetailsby_id($order_id){
        return $this->db->select('*')
                ->from('orders')
                    ->join('order_details','order_details.order_id = orders.order_id')
                ->join('products','products.id = order_details.product_id')
                ->join('customers','customers.id = orders.customer_id')
                ->join('shipping','shipping.shipping_id = orders.shipping_id')
                ->join('payment','payment.payment_id = orders.payment_id')
                ->where('order_details.order_id',$order_id)
                ->get()
                ->result();
    }
    }
