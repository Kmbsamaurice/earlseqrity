<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wishlist_model extends CI_Model
{
    public function wishlist($data){
        $data = array(
            'product_id' => $this->input->post('product_id'),
            'customer_id' => $this->input->post('customer_id'),
        );
        return $this->db->insert('wishlist', $data);
    }
    public function productbyid($id){
        $productinfo =$this->db->select('*')
            ->from('products')
            ->where('id',$id)
            ->get()->row();
        return $productinfo;                
    }
    public function get_lists(){
        $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();

        $customer_id =$data['customer']['id'];
        $this->db->select('*');
        $this->db->from('wishlist');
        $this->db->join('products', 'wishlist.product_id = products.id');
        $this->db->join('customers', 'wishlist.customer_id = customers.id');

        $this->db->where('wishlist.customer_id', $customer_id);
        $this->db->order_by('wishlist.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();

    }
    public function getproduct($product_id){
        $this->db->from('wishlist');
        $this->db->where('product_id', $product_id);
        $result = $this->db->get('');

        if ($result->num_rows() > 0) {
            return $result->row();
        }
    }

    public function deleteproduct($product_id){
        $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();

        $customer_id =$data['customer']['id'];

        $this->db->where('product_id', $product_id);
        $this->db->where('customer_id', $customer_id);
        $this->db->delete('wishlist', array('product_id' => $product_id));
        return TRUE;
    }
    public function wish_exists($product_id){
        $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();

        $customer_id =$data['customer']['id'];

        $this->db->select('*');
        $this->db->from('wishlist');

        $this->db->where('product_id',$product_id);
        $this->db->where('customer_id', $customer_id);

        $query=$this->db->get();
        $result = $query->result_array();
        return $result;
    }
}